<?php

namespace Sashalenz\Binotel\DataTransferObjects;

final class EmployeeDataTransferObject extends BinotelDataTransferObject
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $internalNumber = null;
    public ?string $email = null;

    public static function fromArray(array $array): self
    {
        return new self([
            'id' => isset($array['id'])
                ? (int) $array['id']
                : null,
            'name' => $array['name'] ?? null,
            'internalNumber' => $array['internalNumber'] ?? null,
            'email' => $array['email'] ?? null,
        ]);
    }
}
