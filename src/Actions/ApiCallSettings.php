<?php

namespace Sashalenz\Binotel\Actions;

use Illuminate\Http\JsonResponse;
use Sashalenz\Binotel\DataTransferObjects\Webhook\ApiCallSettingsDataTransferObject;
use Sashalenz\Binotel\Http\Requests\WebhookRequest;

class ApiCallSettings extends WebhookAction
{
    public function handle(): JsonResponse
    {
        return response()->json();
    }

    public function transform(WebhookRequest $request): self
    {
        $this->data = ApiCallSettingsDataTransferObject::fromRequest($request);

        return $this;
    }
}
