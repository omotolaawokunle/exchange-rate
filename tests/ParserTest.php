<?php

namespace Omotolaawokunle\ExchangeRate\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Cache;
use Omotolaawokunle\ExchangeRate\Parser;

class ParserTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Omotolaawokunle\ExchangeRate\ExchangeRateServiceProvider'];
    }


    /** @test */
    public function it_can_get_exchange_rates_from_cache()
    {
        $cachedRates = [
            'USD' => 1.2,
            'GBP' => 0.9,
            'NGN' => 999.9,
            'BGN' => 1.9,
            'CZK' => 24.1
        ];
        Cache::shouldReceive('remember')
            ->once()
            ->andReturn($cachedRates);

        $parser = new Parser();

        $this->assertEquals($cachedRates, $parser->getRates()->toArray());
    }
}
