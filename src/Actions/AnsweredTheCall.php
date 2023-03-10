<?php

namespace Sashalenz\Binotel\Actions;

use Illuminate\Http\JsonResponse;
use Sashalenz\Binotel\DataTransferObjects\Webhook\AnsweredTheCallDataTransferObject;
use Sashalenz\Binotel\Http\Requests\WebhookRequest;

class AnsweredTheCall extends WebhookAction
{
    public function handle(): JsonResponse
    {
        return response()->json();
    }

    public function transform(WebhookRequest $request): self
    {
        $this->data = AnsweredTheCallDataTransferObject::fromRequest($request);

        return $this;
    }
}
