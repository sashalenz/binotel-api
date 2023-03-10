<?php

namespace Sashalenz\Binotel\DataTransferObjects;

use Illuminate\Support\Collection;
use Spatie\DataTransferObject\DataTransferObject;

abstract class BinotelDataTransferObject extends DataTransferObject
{
    abstract public static function fromArray(array $array);

    public static function collectFromArray(?array $array = []) : Collection
    {
        return collect($array)
            ->map(
                fn (array $parameters) => static::fromArray($parameters)
            )
            ->values();
    }
}
