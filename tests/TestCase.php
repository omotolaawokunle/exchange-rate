<?php

namespace Omotolaawokunle\ExchangeRate\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Automatically enables package discoveries.
     *
     * @var bool
     */
    protected $enablesPackageDiscoveries = true;

    protected function getPackageProviders($app)
    {
        return ['Omotolaawokunle\ExchangeRate\ExchangeRateServiceProvider'];
    }
}
