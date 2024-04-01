<?php

namespace Sashalenz\Binotel\Casts;

use Illuminate\Support\Str;
use Propaganistas\LaravelPhone\PhoneNumber;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class PhoneNumberCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        $number = Str::of($value);

        if ($number->startsWith('00')) {
            return new PhoneNumber($number->replaceFirst('00', '+'));
        }

        if ($number->startsWith('0') && $number->length() === 10) {
            return new PhoneNumber($number, 'UA');
        }

        return null;
    }
}
