<?php

namespace Sashalenz\Binotel\ResponseData\Webhooks;

use Propaganistas\LaravelPhone\PhoneNumber;
use Sashalenz\Binotel\Casts\PhoneNumberCast;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class AnsweredTheCallData extends Data
{
    public function __construct(
        public int $generalCallID,
        public int $callType,
        public int $companyID,
        public string $requestType,
        public ?string $pbxNumber = null,
        #[WithCast(PhoneNumberCast::class)]
        public ?PhoneNumber $externalNumber = null,
        public ?int $internalNumber = null,
    ) { }
}
