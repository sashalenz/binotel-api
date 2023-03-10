<?php

namespace Sashalenz\Binotel;

use Sashalenz\Binotel\ApiModels\Calls;
use Sashalenz\Binotel\ApiModels\Customers;
use Sashalenz\Binotel\ApiModels\Settings;
use Sashalenz\Binotel\ApiModels\Stats;

final class Binotel
{
    public static function customers(): Customers
    {
        return new Customers();
    }

    public static function stats(): Stats
    {
        return new Stats();
    }

    public static function settings(): Settings
    {
        return new Settings();
    }

    public static function calls(): Calls
    {
        return new Calls();
    }
}
