<?php

namespace Sashalenz\Binotel\Casts;

use Illuminate\Support\Collection;
use Sashalenz\Binotel\ResponseData\HistoryData;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class HistoryDataCollectionCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): Collection
    {
        if ($value instanceof Collection) {
            return $value->map(static fn ($item) => $item instanceof HistoryData ? $item : HistoryData::from($item));
        }

        return collect((array) ($value ?? []))
            ->map(static fn ($item) => $item instanceof HistoryData ? $item : HistoryData::from($item));
    }
}
