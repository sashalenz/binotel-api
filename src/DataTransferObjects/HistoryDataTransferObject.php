<?php

namespace Sashalenz\Binotel\DataTransferObjects;

final class HistoryDataTransferObject extends BinotelDataTransferObject
{
    public ?string $internalNumber = null;
    public ?string $internalAdditionalData = null;
    public ?EmployeeDataTransferObject $employeeData = null;
    public int $waitsec;
    public int $billsec;
    public string $disposition;

    public static function fromArray(array $array): self
    {
        return new self([
            'internalNumber' => $array['internalNumber'] ?? null,
            'internalAdditionalData' => $array['internalAdditionalData'] ?? null,
            'employeeData' => ! empty($array['employeeData'])
                ? EmployeeDataTransferObject::fromArray($array['employeeData'])
                : null,
            'waitsec' => (int) $array['waitsec'],
            'billsec' => (int) $array['billsec'],
            'disposition' => $array['disposition'],
        ]);
    }
}
