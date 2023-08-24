<?php

namespace Jaymeh\FilamentPublishable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Jaymeh\FilamentPublishable\FilamentPublishable
 */
class FilamentPublishable extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Jaymeh\FilamentPublishable\FilamentPublishable::class;
    }
}
