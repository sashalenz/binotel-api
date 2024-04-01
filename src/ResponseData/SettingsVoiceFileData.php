<?php

namespace Sashalenz\Binotel\ResponseData;

use Spatie\LaravelData\Data;

final class SettingsVoiceFileData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $type,
    ) { }
}
