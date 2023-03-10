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
     * @return Collection
     * @throws BinotelException
     */
    public function make(): Collection
    {
        $this->params['key'] = $this->key;
        $this->params['secret'] = $this->secret;

        $link = $this->url . $this->version .'/'. $this->method .'.'. $this->format;

        try {
            return Http::timeout(self::TIMEOUT)
                ->retry(
                    self::RETRY_TIMES,
                    self::RETRY_SLEEP
                )
                ->asJson()
                ->post(
                    $link,
                    $this->params
                )
                ->throw()
                ->collect();
        } catch (RequestException $e) {
            throw new BinotelException('API Exception: ' . $e->getMessage());
        }
    }

    public function cache(int $seconds = -1) : Collection
    {
        if ($seconds === -1) {
            return Cache::rememberForever($this->getCacheKey(), fn () => $this->make());
        }

        return Cache::remember($this->getCacheKey(), $seconds, fn () => $this->make());
    }

    private function getCacheKey() : string
    {
        return $this->method.'_'.collect($this->params)->values()->implode('_');
    }
}
