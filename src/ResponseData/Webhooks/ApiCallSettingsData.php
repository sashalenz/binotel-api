<?php

namespace Sashalenz\Binotel\ResponseData\Webhooks;

use Propaganistas\LaravelPhone\PhoneNumber;
use Sashalenz\Binotel\Casts\PhoneNumberCast;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

final class ApiCallSettingsData extends Data
{
    public function __construct(
        public string $requestType,
        #[WithCast(PhoneNumberCast::class)]
        public PhoneNumber $externalNumber,
        public int $companyID,
        public int $callType,
        public ?string $pbxNumber = null,
        public ?int $internalNumber = null,
    ) { }
}
