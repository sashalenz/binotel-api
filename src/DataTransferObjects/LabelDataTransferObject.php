<?php

namespace Sashalenz\Binotel\DataTransferObjects;

final class LabelDataTransferObject extends BinotelDataTransferObject
{
    public int $id;
    public string $name;

    public static function fromArray(array $array): self
    {
        return new self([
            'id' => (int) $array['id'],
            'name' => $array['name'],
        ]);
    }
}
