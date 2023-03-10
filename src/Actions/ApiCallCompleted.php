<?php

namespace Sashalenz\Binotel\Actions;

use Illuminate\Http\JsonResponse;
use Sashalenz\Binotel\DataTransferObjects\Webhook\ApiCallCompletedDataTransferObject;
use Sashalenz\Binotel\Http\Requests\WebhookRequest;

class ApiCallCompleted extends WebhookAction
{
    public function handle(): JsonResponse
    {
        return response()->json();
    }

    public function transform(WebhookRequest $request): self
    {
        $this->data = ApiCallCompletedDataTransferObject::fromRequest($request);

        return $this;
    }
}
