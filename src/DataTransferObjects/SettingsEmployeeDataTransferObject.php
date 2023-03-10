<?php

namespace Sashalenz\Binotel\DataTransferObjects;

final class SettingsEmployeeDataTransferObject extends BinotelDataTransferObject
{
    public int $employeeID;
    public string $email;
    public string $name;
    public ?string $mobileNumber = null;
    public string $presenceState;
    public string $presenceStateUpdatedAt;
    public string $role;
    public string $department;
    public bool $wireIsEnabled;
    public bool $crmIsEnabled;
    public bool $chatIsEnabled;
    public bool $callCenterIsEnabled;
    public string $language;
    public SettingsVoiceFileDataTransferObject $endpointData;

    public static function fromArray(array $array): self
    {
        return new self([
            'employeeID' => (int) $array['employeeID'],
            'email' => $array['email'],
            'name' => $array['name'],
            'mobileNumber' => $array['mobileNumber'],
            'presenceState' => $array['presenceState'],
            'presenceStateUpdatedAt' => $array['presenceStateUpdatedAt'],
            'role' => $array['role'],
            'department' => $array['department'],
            'crmIsEnabled' => (bool) $array['crmIsEnabled'],
            'chatIsEnabled' => (bool) $array['chatIsEnabled'],
            'wireIsEnabled' => (bool) $array['wireIsEnabled'],
            'callCenterIsEnabled' => (bool) $array['callCenterIsEnabled'],
            'language' => $array['language'],
            'endpointData' => SettingsEndpointDataTransferObject::fromArray($array['endpointData']),
        ]);
    }
}
