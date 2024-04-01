<?php

namespace Sashalenz\Binotel\Actions;

use Illuminate\Http\JsonResponse;
use Sashalenz\Binotel\Http\Requests\WebhookRequest;
use Sashalenz\Binotel\ResponseData\Webhooks\HangupTheCallData;

class HangupTheCall extends WebhookAction
{
    public function handle(): JsonResponse
    {
        return response()->json();
    }

    public function transform(WebhookRequest $request): self
    {
        $this->data = HangupTheCallData::from($request);

        return $this;
    }
}
