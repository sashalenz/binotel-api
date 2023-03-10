<?php

namespace Sashalenz\Binotel\Actions;

use Illuminate\Http\JsonResponse;
use Sashalenz\Binotel\Http\Requests\WebhookRequest;
use Spatie\DataTransferObject\DataTransferObject;

abstract class WebhookAction
{
    protected ?DataTransferObject $data = null;

    abstract public function handle(): JsonResponse;

    abstract public function transform(WebhookRequest $request): self;
}
