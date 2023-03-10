<?php

namespace Sashalenz\Binotel\DataTransferObjects;

final class PbxNumberDataTransferObject extends BinotelDataTransferObject
{
    public ?string $name = null;
    public ?string $number = null;

    public static function fromArray(array $array): self
    {
        return new self([
            'name' => $array['name'] ?? null,
            'number' => $array['number'] ?? null,
        ]);
    }
}
