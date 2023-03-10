<?php

namespace Sashalenz\Binotel\DataTransferObjects;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Propaganistas\LaravelPhone\PhoneNumber;

final class StatDataTransferObject extends BinotelDataTransferObject
{
    public int $companyID;
    public int $generalCallID;
    public int $callID;
    public Carbon $startTime;
    public int $callType;
    public ?int $internalNumber = null;
    public ?string $internalAdditionalData = null;
    public ?PhoneNumber $externalNumber = null;
    public int $waitsec;
    public int $billsec;
    public string $disposition;
    public ?string $recordingStatus = null;
    public bool $isNewCall;
    public ?CustomerDataTransferObject $customerData = null;
    public ?EmployeeDataTransferObject $employeeData = null;
    public PbxNumberDataTransferObject $pbxNumberData;
    public Collection $historyData;
    public ?CallTrackingDataTransferObject $callTrackingData = null;
    public ?GetCallDataTransferObject $getCallData = null;
    public ?string $smsContent = null;

    public static function fromArray(array $array): self
    {
        return new self([
            'companyID' => (int) $array['companyID'],
            'generalCallID' => (int) $array['generalCallID'],
            'callID' => (int) $array['callID'],
            'startTime' => Carbon::createFromTimestamp($array['startTime']),
            'callType' => (int) $array['callType'],
            'internalNumber' => ! empty($array['internalNumber'])
                ? (int) $array['internalNumber']
                : null,
            'internalAdditionalData' => $array['internalAdditionalData'] ?? null,
            'externalNumber' => self::parseExternalNumber($array['externalNumber']),
            'waitsec' => (int) $array['waitsec'],
            'billsec' => (int) $array['billsec'],
            'disposition' => $array['disposition'],
            'recordingStatus' => $array['recordingStatus'] ?? null,
            'isNewCall' => (bool) $array['isNewCall'],
            'customerData' => ! empty($array['customerData'])
                ? CustomerDataTransferObject::fromArray($array['customerData'])
                : null,
            'employeeData' => ! empty($array['employeeData'])
                ? EmployeeDataTransferObject::fromArray($array['employeeData'])
                : null,
            'pbxNumberData' => PbxNumberDataTransferObject::fromArray($array['pbxNumberData']),
            'historyData' => HistoryDataTransferObject::collectFromArray($array['historyData']),
            'callTrackingData' => isset($array['callTrackingData'])
                ? CallTrackingDataTransferObject::fromArray($array['callTrackingData'])
                : null,
            'getCallData' => isset($array['getCallData'])
                ?  CallTrackingDataTransferObject::fromArray($array['getCallData'])
                : null,
            'smsContent' => $array['smsContent'] ?? null,
        ]);
    }

    private static function parseExternalNumber(string $number):? PhoneNumber
    {
        $number = Str::of($number);

        if ($number->startsWith('00')) {
            return new PhoneNumber($number->replaceFirst('00', '+')->toString());
        }

        if ($number->startsWith('0') && $number->length() === 10) {
            return new PhoneNumber($number, 'UA');
        }

        return null;
    }
}
