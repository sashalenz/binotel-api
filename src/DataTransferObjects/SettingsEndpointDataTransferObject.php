<?php

namespace Sashalenz\Binotel\DataTransferObjects;

final class SettingsEndpointDataTransferObject extends BinotelDataTransferObject
{
    public int $id;
    public string $login;
    public string $password;
    public string $internalNumber;
    public array $status;

    public static function fromArray(array $array): self
    {
        return new self([
            'id' => (int) $array['id'],
            'login' => $array['login'],
            'password' => $array['password'],
            'internalNumber' => $array['internalNumber'],
            'status' => $array['status'],
        ]);
    }
}
