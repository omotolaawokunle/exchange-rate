<?php

namespace Omotolaawokunle\ExchangeRate;

use Carbon\Carbon;
use SimpleXMLElement;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class Parser
{
    protected array $rates = [];

    private string $xmlUrl = "https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";

    private string $baseCurrency;

    public function __construct()
    {
        $this->baseCurrency = Config::get('exchange-rate.base_currency');
        $today = Carbon::today()->format('Y-m-d');
        $this->rates = Cache::remember("rates-{$today}", 24 * 60 * 60, fn () => $this->getExchangeRates());
    }

    protected function getExchangeRates(): array
    {
        $client = new Client;
        $response = $client->get($this->xmlUrl);
        $xmlContent = $response->getBody();

        $xml = new SimpleXMLElement($xmlContent);

        $exchangeRates = [];

        foreach ($xml->Cube->Cube->Cube as $cube) {
            $currency = (string) $cube['currency'];
            $rate = (float) $cube['rate'];

            $exchangeRates[$currency] = $rate;
        }

        $exchangeRates[$this->baseCurrency] = 1.0;

        return $exchangeRates;
    }

    public function getRates(): Collection
    {
        return new Collection($this->rates);
    }

    public function getBaseCurrency(): string
    {
        return $this->baseCurrency;
    }
}
