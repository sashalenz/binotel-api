<?php

namespace Sashalenz\Binotel\ResponseData;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Propaganistas\LaravelPhone\PhoneNumber;
use Sashalenz\Binotel\Casts\HistoryDataCollectionCast;
use Sashalenz\Binotel\Casts\PhoneNumberCast;
use Sashalenz\Binotel\Casts\TimestampCast;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

final class StatData extends Data
{
    /**
     * Binotel sometimes returns an empty string `""` for optional nested
     * objects (customerData, employeeData, callTrackingData, getCallData)
     * and for the historyData array when there is no associated record.
     * spatie-laravel-data has no normalizer for `string -> Data`, so we
     * coerce those `""` to `null` / `[]` before the pipeline runs.
     */
    public static function prepareForPipeline(array $properties): array
    {
        foreach (['customerData', 'employeeData', 'callTrackingData', 'getCallData'] as $key) {
            if (($properties[$key] ?? null) === '') {
                $properties[$key] = null;
            }
        }

        if (($properties['historyData'] ?? null) === '') {
            $properties['historyData'] = [];
        }

        // Binotel sometimes returns numeric fields as strings (e.g. internalNumber="801").
        // Coerce numeric strings to int so the typed `?int` constructor argument accepts them.
        foreach (['internalNumber'] as $key) {
            if (isset($properties[$key]) && is_string($properties[$key]) && is_numeric($properties[$key])) {
                $properties[$key] = (int) $properties[$key];
            } elseif (($properties[$key] ?? null) === '') {
                $properties[$key] = null;
            }
        }

        return $properties;
    }

    public function __construct(
        public int $companyID,
        public int $generalCallID,
        public int $callID,
        #[WithCast(TimestampCast::class)]
        public Carbon $startTime,
        public int $callType,
        public int $waitsec,
        public int $billsec,
        public string $disposition,
        public bool $isNewCall,
        #[WithCast(HistoryDataCollectionCast::class)]
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
