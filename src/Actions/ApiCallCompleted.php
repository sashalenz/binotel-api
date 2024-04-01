<?php

namespace Sashalenz\Binotel\Actions;

use Illuminate\Http\JsonResponse;
use Sashalenz\Binotel\Http\Requests\WebhookRequest;
use Sashalenz\Binotel\ResponseData\Webhooks\ApiCallCompletedData;

class ApiCallCompleted extends WebhookAction
{
    public function handle(): JsonResponse
    {
        return response()->json();
    }

    public function transform(WebhookRequest $request): self
    {
        $this->data = ApiCallCompletedData::from($request);

        return $this;
    }
}
