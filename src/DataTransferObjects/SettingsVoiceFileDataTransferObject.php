<?php

namespace Sashalenz\Binotel\DataTransferObjects;

final class SettingsVoiceFileDataTransferObject extends BinotelDataTransferObject
{
    public int $id;
    public string $name;
    public string $type;

    public static function fromArray(array $array): self
    {
        return new self([
            'id' => (int) $array['id'],
            'name' => $array['name'],
            'type' => $array['type'],
        ]);
    }
}
