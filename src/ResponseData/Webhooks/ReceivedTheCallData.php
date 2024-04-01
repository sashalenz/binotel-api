<?php

namespace Sashalenz\Binotel\ResponseData\Webhooks;

use Illuminate\Support\Str;
use Propaganistas\LaravelPhone\PhoneNumber;
use Sashalenz\Binotel\Casts\PhoneNumberCast;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class ReceivedTheCallData extends Data
{
    public function __construct(
        public int $generalCallID,
        public int $callType,
        public int $companyID,
        public string $requestType,
        public string $method,
        public ?string $didNumber = null,
        public ?string $did = null,
        public ?string $srcNumber = null,
        public ?string $pbxNumber = null,
        #[WithCast(PhoneNumberCast::class)]
        public ?PhoneNumber $externalNumber = null,
        public ?int $internalNumber = null,
    ) { }

    private static function parseExternalNumber(string $number):? PhoneNumber
    {

    }
}
