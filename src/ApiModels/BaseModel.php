<?php

namespace Sashalenz\Binotel\ApiModels;

use Illuminate\Support\Facades\Validator;
use Sashalenz\Binotel\Exceptions\BinotelException;
use Sashalenz\Binotel\Request;
use Spatie\LaravelData\Contracts\BaseData;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Resolvers\DataFromSomethingResolver;

abstract class BaseModel
{
    protected bool $canBeCached = false;
    protected int $cacheSeconds = -1;
    protected string $model;
    private array $params = [];
    private ?string $method = null;

    /**
     * @param int $seconds
     * @return $this
     */
    public function cache(int $seconds = -1) : self
    {
        $this->canBeCached = true;
        $this->cacheSeconds = $seconds;

        return $this;
    }

    protected function method(string $method) : self
    {
        $this->method = $this->model . '/' . $method;

        return $this;
    }

    protected function params(array $params): self
    {
        $this->params = $params;

        return $this;
    }

    /**
     * @param array $rules
     * @return $this
     * @throws BinotelException
     */
    protected function validate(array $rules = []): self
    {
        $validator = Validator::make(
            $this->params,
            $rules
        );

        if ($validator->fails()) {
            throw new BinotelException('Validation exception ' . $validator->errors()->first());
        }

        return $this;
    }

    /**
     * @throws BinotelException
     */
    public function request(?string $key = null): mixed
    {
        if (is_null($this->method)) {
            throw new BinotelException('API Exception: Provide method first');
        }

        $request = new Request($this->method, $this->params);

        if ($this->canBeCached) {
            return $request->cache($this->cacheSeconds);
        }

        return $request->make($key);
    }


    /**
     * @throws BinotelException
     */
    protected function get(?string $key): mixed
    {
        return $this->request($key);
    }

    /**
     * @throws BinotelException
     */
    protected function first(): array
    {
        return $this->request()[0] ?? [];
    }

    /**
     * @throws BinotelException
     */
    protected function toData(
        /** @var class-string<BaseData> $class */
        string $class
    ): BaseData {
        return app(DataFromSomethingResolver::class)->execute(
            $class,
            $this->first()
        );
    }

    /**
     * @throws BinotelException
     */
    protected function toCollection(
        /** @var class-string<BaseData> $class */
        string $class,
        ?string $key = null
    ): DataCollection {
        return new DataCollection($class, $this->request($key));
    }
}
