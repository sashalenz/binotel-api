<?php

namespace Sashalenz\Binotel\ResponseData;

use Spatie\LaravelData\Data;

final class HistoryData extends Data
{
    public function __construct(
        public int $waitsec,
        public int $billsec,
        public string $disposition,
        public ?string $internalNumber = null,
        public ?string $internalAdditionalData = null,
        public ?EmployeeData $employeeData = null,
    ) { }
}
