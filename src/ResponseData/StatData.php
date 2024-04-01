<?php

namespace Sashalenz\Binotel\ResponseData;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Propaganistas\LaravelPhone\PhoneNumber;
use Sashalenz\Binotel\Casts\PhoneNumberCast;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

final class StatData extends Data
{
    public function __construct(
        public int $companyID,
        public int $generalCallID,
        public int $callID,
        public Carbon $startTime,
        public int $callType,
        public int $waitsec,
        public int $billsec,
        public string $disposition,
        public bool $isNewCall,
        public Collection $historyData,
        public PbxNumberData $pbxNumberData,
        public ?string $recordingStatus = null,
        public ?CustomerData $customerData = null,
        public ?EmployeeData $employeeData = null,
        public ?CallTrackingData $callTrackingData = null,
        public ?GetCallData $getCallData = null,
        public ?string $smsContent = null,
        public ?int $internalNumber = null,
        public ?string $internalAdditionalData = null,
        #[WithCast(PhoneNumberCast::class)]
        public ?PhoneNumber $externalNumber = null,
    ) { }
}
