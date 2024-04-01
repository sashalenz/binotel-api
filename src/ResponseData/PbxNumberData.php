<?php

namespace Sashalenz\Binotel\ResponseData;

use Spatie\LaravelData\Data;

final class PbxNumberData extends Data
{
    public function __construct(
        public ?string $name = null,
        public ?string $number = null,
    ) { }
}
