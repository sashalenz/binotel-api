<?php

namespace Sashalenz\Binotel\ResponseData;

use Spatie\LaravelData\Data;

final class SettingsEmployeeData extends Data
{
    public function __construct(
        public int $employeeID,
        public string $email,
        public string $name,
        public string $presenceState,
        public string $presenceStateUpdatedAt,
        public string $role,
        public string $department,
        public bool $wireIsEnabled,
        public bool $crmIsEnabled,
        public bool $chatIsEnabled,
        public bool $callCenterIsEnabled,
        public string $language,
        public SettingsVoiceFileData $endpointData,
        public ?string $mobileNumber = null,
    ) { }
}
