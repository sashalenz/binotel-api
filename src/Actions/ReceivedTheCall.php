<?php

namespace Sashalenz\Binotel\Actions;

use Illuminate\Http\JsonResponse;
use Sashalenz\Binotel\DataTransferObjects\Webhook\ReceivedTheCallDataTransferObject;
use Sashalenz\Binotel\Http\Requests\WebhookRequest;

class ReceivedTheCall extends WebhookAction
{
    public function handle(): JsonResponse
    {
        return response()->json();
    }

    public function transform(WebhookRequest $request): self
    {
        $this->data = ReceivedTheCallDataTransferObject::fromRequest($request);

        return $this;
    }
}
