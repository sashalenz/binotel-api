<?php

namespace Sashalenz\Binotel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sashalenz\Binotel\Binotel
 */
class BinotelFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'binotel';
    }
}
