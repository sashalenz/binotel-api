<?php

namespace Sashalenz\Binotel\Casts;

use Carbon\Carbon;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class TimestampCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): ?Carbon
    {
        if (blank($value)) {
            return null;
        }

        if ($value instanceof Carbon) {
            return $value;
        }

        if (is_numeric($value)) {
            return Carbon::createFromTimestamp((int) $value);
        }

        return Carbon::parse((string) $value);
    }
}
