<?php

namespace Sashalenz\Binotel\DataTransferObjects\Webhook;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

final class ApiCallCompletedDataTransferObject extends DataTransferObject
{
    public string $requestType;
    public array $callDetails;

    public static function fromRequest(Request $request): self
    {
        return new self([
            'requestType' => $request->input('requestType'),
            'callDetails' => $request->input('callDetails'),
        ]);
    }
}
