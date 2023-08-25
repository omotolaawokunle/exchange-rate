<?php

namespace Omotolaawokunle\ExchangeRate;

use Illuminate\Support\Collection;

class ExchangeRate
{
    protected Collection $todaysRates;

    public function __construct(protected Parser $parser)
    {
        $this->todaysRates = $this->parser->getRates();
    }

    public function exchange(float $amount, string $currency): float
    {
        if ($this->parser->getBaseCurrency() !== "EUR") {
            $amount = $this->exchangeFromDefaultCurrencyToEuro($amount, $currency);
        }
        return $this->exchangeFromEuroToOtherCurrency($amount, $currency);
    }

    public function exchangeFromEuroToOtherCurrency(float $amount, string $currency): float
    {
        if ($this->todaysRates->has($currency)) {
            $rate = $this->todaysRates->get($currency, 0);
            return (float) $amount * $rate;
        }
        throw new \Exception("Currency {$currency} not found.");
    }

    public function exchangeFromDefaultCurrencyToEuro($amount, $currency): float
    {
        if ($this->todaysRates->has($currency)) {
            $rate = $this->todaysRates->get($currency, 0);
            return (float) $amount / $rate;
        }
        throw new \Exception("Currency {$currency} not found.");
    }
}
