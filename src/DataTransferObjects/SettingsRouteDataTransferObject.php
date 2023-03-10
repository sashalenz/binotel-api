<?php

namespace Sashalenz\Binotel\DataTransferObjects;

final class SettingsRouteDataTransferObject extends BinotelDataTransferObject
{
    public int $id;
    public string $name;
    public string $description;

    public static function fromArray(array $array): self
    {
        return new self([
            'id' => (int) $array['id'],
            'name' => $array['name'],
            'description' => $array['description'],
        ]);
    }
}
