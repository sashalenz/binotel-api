<?php

namespace Sashalenz\Binotel\Casts;

use Illuminate\Support\Str;
use Propaganistas\LaravelPhone\PhoneNumber;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;
use Throwable;

class PhoneNumberCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): ?PhoneNumber
    {
        if (blank($value)) {
            return null;
        }

        $number = Str::of((string) $value)->trim();

        try {
            $phone = match (true) {
                $number->startsWith('+')                                 => new PhoneNumber((string) $number),
                $number->startsWith('00')                                => new PhoneNumber((string) $number->replaceFirst('00', '+')),
                $number->startsWith('0') && $number->length() === 10     => new PhoneNumber((string) $number, 'UA'),
                default                                                  => null,
            };
        } catch (Throwable) {
            return null;
        }

        if ($phone === null) {
            return null;
        }

        try {
            return $phone->isValid() ? $phone : null;
        } catch (Throwable) {
            return null;
        }
    }
}
