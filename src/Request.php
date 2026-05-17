<?php

namespace Sashalenz\Binotel;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Sashalenz\Binotel\Exceptions\BinotelException;

final class Request
{
    private static ?float $lastRequestAt = null;

    private string $key;
    private string $secret;
    private string $version;
    private string $format;
    private string $url;
    private string $method;
    private array $params;

    public function __construct(string $method, array $params)
    {
        $this->method = $method;
        $this->params = $params;

        $this->key = Config::get('binotel-api.key');
        $this->secret = Config::get('binotel-api.secret');
        $this->version = Config::get('binotel-api.version');
        $this->url = Config::get('binotel-api.url');
        $this->format = Config::get('binotel-api.format');
    }

    /**
     * @throws BinotelException
     */
    public function make(?string $key = null): mixed
    {
        $this->params['key'] = $this->key;
        $this->params['secret'] = $this->secret;

        $timeout = (int) Config::get('binotel-api.http.timeout', 15);
        $connectTimeout = (int) Config::get('binotel-api.http.connect_timeout', 10);
        $retryTimes = (int) Config::get('binotel-api.http.retry_times', 5);
        $retrySleep = (int) Config::get('binotel-api.http.retry_sleep', 1000);
        $retryMaxSleep = (int) Config::get('binotel-api.http.retry_max_sleep', 15000);

        $this->throttle();

        try {
            return Http::timeout($timeout)
                ->connectTimeout($connectTimeout)
                ->baseUrl($this->url)
                ->retry(
                    $retryTimes,
                    function (int $attempt) use ($retrySleep, $retryMaxSleep): int {
                        $backoff = $retrySleep * (2 ** ($attempt - 1));
                        $capped = min($backoff, $retryMaxSleep);

                        return $capped + random_int(0, (int) max(1, $capped * 0.1));
                    },
                    function (\Throwable $exception): bool {
                        if ($exception instanceof ConnectionException) {
                            return true;
                        }

                        if ($exception instanceof RequestException) {
                            $status = $exception->response->status();

                            return $status === 429 || $status >= 500;
                        }

                        return false;
                    },
                    throw: false
                )
                ->asJson()
                ->post(
                    sprintf('%s/%s.%s', $this->version, $this->method, $this->format),
                    $this->params
                )
                ->throw()
                ->json($key);
        } catch (ConnectionException $e) {
            throw new BinotelException('API Exception: ' . $e->getMessage());
        } catch (RequestException $e) {
            throw new BinotelException('API Exception: ' . $e->getMessage());
        } finally {
            self::$lastRequestAt = microtime(true);
        }
    }

    public function cache(int $seconds = -1) : array
    {
        if ($seconds === -1) {
            return Cache::rememberForever(
                $this->getCacheKey(),
                fn () => $this->make()
            );
        }

        return Cache::remember(
            $this->getCacheKey(),
            $seconds,
            fn () => $this->make()
        );
    }

    private function throttle(): void
    {
        $gap = (int) Config::get('binotel-api.http.throttle_ms', 0);

        if ($gap <= 0 || self::$lastRequestAt === null) {
            return;
        }

        $elapsedMs = (microtime(true) - self::$lastRequestAt) * 1000;

        if ($elapsedMs < $gap) {
            usleep((int) (($gap - $elapsedMs) * 1000));
        }
    }

    private function getCacheKey() : string
    {
        return $this->method.'_'.collect($this->params)->values()->implode('_');
    }
}
