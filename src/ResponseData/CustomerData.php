<?php

namespace Sashalenz\Binotel\ResponseData;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

final class CustomerData extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $description = null,
        public readonly ?string $email = null,
        public readonly ?EmployeeData $assignedToEmployee = null,
        public readonly array $numbers = [],
        #[DataCollectionOf(LabelData::class)]
        public readonly ?DataCollection $labels = null,
    ) { }
}
