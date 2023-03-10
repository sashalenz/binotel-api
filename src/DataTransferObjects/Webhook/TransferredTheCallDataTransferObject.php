<?php

namespace Sashalenz\Binotel\DataTransferObjects\Webhook;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class TransferredTheCallDataTransferObject extends DataTransferObject
{
    public int $internalNumber;
    public int $generalCallID;
    public int $companyID;
    public string $requestType;

    public static function fromRequest(Request $request): self
    {
        return new self([
            'internalNumber' => (int) $request->input('internalNumber'),
            'generalCallID' => (int) $request->input('generalCallID'),
            'companyID' => (int) $request->input('companyID'),
            'requestType' => $request->input('requestType'),
        ]);
    }
}
