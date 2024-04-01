<?php

namespace Sashalenz\Binotel\ResponseData;

use Spatie\LaravelData\Data;

final class SettingsEndpointData extends Data
{
    public function __construct(
        public int $id,
        public string $login,
        public string $password,
        public string $internalNumber,
        public array $status,
    ) { }
}
