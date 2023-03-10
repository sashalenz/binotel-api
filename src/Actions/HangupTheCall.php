<?php

namespace Sashalenz\Binotel\Actions;

use Illuminate\Http\JsonResponse;
use Sashalenz\Binotel\DataTransferObjects\Webhook\HangupTheCallDataTransferObject;
use Sashalenz\Binotel\Http\Requests\WebhookRequest;

class HangupTheCall extends WebhookAction
{
    public function handle(): JsonResponse
    {
        return response()->json();
    }

    public function transform(WebhookRequest $request): self
    {
        $this->data = HangupTheCallDataTransferObject::fromRequest($request);

        return $this;
    }
}
