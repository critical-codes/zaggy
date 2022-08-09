<?php

namespace CriticalCodes\Zaggy\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CriticalCodes\Zaggy\Zaggy
 */
class Zaggy extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \CriticalCodes\Zaggy\Zaggy::class;
    }
}
