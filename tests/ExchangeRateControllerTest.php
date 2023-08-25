<?php

namespace Omotolaawokunle\ExchangeRate\Tests;


use Omotolaawokunle\ExchangeRate\ExchangeRate;

class ExchangeRateControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Mock the ExchangeRate class
        $this->app->bind(ExchangeRate::class, function ($app) {
            return $this->createMock(ExchangeRate::class);
        });
    }

    /** @test */
    public function it_can_calculate_exchange_rate()
    {
        $this->mock(ExchangeRate::class, function ($mock) {
            $mock->shouldReceive('exchange')
                ->once()
                ->with(100, 'USD')
                ->andReturn(120);
        });
        $response = $this->postJson(route('exchange-rate.index'), [
            'amount' => 100,
            'currency' => 'USD',
        ]);
        $response->assertOk()
            ->assertJsonStructure([
                'success',
                'data' => ['amount']
            ]);
    }

    /** @test */
    public function it_returns_error_for_invalid_request()
    {
        $response = $this->postJson(route('exchange-rate.index'), []);

        $response->assertStatus(422)
            ->assertJsonStructure(['errors']);
    }

    /** @test */
    public function it_returns_error_for_invalid_currency()
    {
        $response = $this->postJson(route('exchange-rate.index'), [
            'amount' => 100,
            'currency' => 'UDD',
        ]);
        $response->assertStatus(400)
            ->assertJsonStructure(['error']);
    }
}
