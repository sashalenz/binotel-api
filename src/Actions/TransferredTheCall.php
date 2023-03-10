<?php


namespace Sashalenz\Binotel\Actions;

use Illuminate\Http\JsonResponse;
use Sashalenz\Binotel\DataTransferObjects\Webhook\TransferredTheCallDataTransferObject;
use Sashalenz\Binotel\Http\Requests\WebhookRequest;

class TransferredTheCall extends WebhookAction
{
    public function handle(): JsonResponse
    {
        return response()->json();
    }

    public function transform(WebhookRequest $request): self
    {
        $this->data = TransferredTheCallDataTransferObject::fromRequest($request);

        return $this;
    }
}
