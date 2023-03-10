<?php

namespace Sashalenz\Binotel\DataTransferObjects\Webhook;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class HangupTheCallDataTransferObject extends DataTransferObject
{
    public int $generalCallID;
    public int $billsec;
    public string $disposition;
    public string $requestType;
    public string $method;

    public static function fromRequest(Request $request): self
    {
        return new self([
            'generalCallID' => (int) $request->input('generalCallID'),
            'billsec' => (int) $request->input('billsec'),
            'disposition' => $request->input('disposition'),
            'requestType' => $request->input('requestType'),
            'method' => $request->input('method'),
        ]);
    }
}
