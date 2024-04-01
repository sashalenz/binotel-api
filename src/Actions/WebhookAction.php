<?php

namespace Sashalenz\Binotel\Actions;

use Illuminate\Http\JsonResponse;
use Sashalenz\Binotel\Http\Requests\WebhookRequest;
use Spatie\LaravelData\Data;

abstract class WebhookAction
{
    protected ?Data $data = null;

    abstract public function handle(): JsonResponse;

    abstract public function transform(WebhookRequest $request): self;
}
