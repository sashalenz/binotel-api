<?php

namespace Sashalenz\Binotel\DataTransferObjects\Webhook;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Propaganistas\LaravelPhone\PhoneNumber;
use Spatie\DataTransferObject\DataTransferObject;

class AnsweredTheCallDataTransferObject extends DataTransferObject
{
    public ?string $pbxNumber = null;
    public ?PhoneNumber $externalNumber = null;
    public ?int $internalNumber = null;
    public int $generalCallID;
    public int $callType;
    public int $companyID;
    public string $requestType;

    public static function fromRequest(Request $request): self
    {
        return new self([
            'requestType' => $request->input('requestType'),
            'pbxNumber' => $request->input('pbxNumber'),
            'internalNumber' => (int) $request->input('internalNumber'),
            'externalNumber' => self::parseExternalNumber($request->input('externalNumber')),
            'companyID' => (int) $request->input('companyID'),
            'generalCallID' => (int) $request->input('generalCallID'),
            'callType' => (int) $request->input('callType'),
        ]);
    }

    private static function parseExternalNumber(string $number):? PhoneNumber
    {
        $number = Str::of($number);

        if ($number->startsWith('00')) {
            return new PhoneNumber($number->replaceFirst('00', '+'));
        }

        if ($number->startsWith('0') && $number->length() === 10) {
            return new PhoneNumber($number, 'UA');
        }

        return null;
    }
}
