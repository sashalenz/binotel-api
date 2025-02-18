<?php

namespace Sashalenz\Binotel;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Sashalenz\Binotel\Exceptions\BinotelException;

final class Request
{
    private const TIMEOUT = 3;
    private const RETRY_TIMES = 3;
    private const RETRY_SLEEP = 100;

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

        try {
            return Http::timeout(self::TIMEOUT)
                ->baseUrl($this->url)
                ->retry(
                    self::RETRY_TIMES,
                    self::RETRY_SLEEP
                )
                ->asJson()
                ->post(
                    sprintf('%s/%s.%s', $this->version, $this->method, $this->format),
                    $this->params
                )
                ->throw()
                ->json($key);
        } catch (RequestException $e) {
            throw new BinotelException('API Exception: ' . $e->getMessage());
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

    private function getCacheKey() : string
    {
        return $this->method.'_'.collect($this->params)->values()->implode('_');
    }
}
