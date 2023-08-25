<?php

namespace Omotolaawokunle\ExchangeRate\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Omotolaawokunle\ExchangeRate\Skeleton\SkeletonClass
 */
class ExchangeRateFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'exchange-rate';
    }
}
