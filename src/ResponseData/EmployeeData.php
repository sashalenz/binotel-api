<?php

namespace Sashalenz\Binotel\ResponseData;

use Spatie\LaravelData\Data;

final class EmployeeData extends Data
{
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
        public ?string $internalNumber = null,
        public ?string $email = null
    ) {}
}
