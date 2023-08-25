<?php

namespace Omotolaawokunle\ExchangeRate\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Omotolaawokunle\ExchangeRate\ExchangeRate;
use Omotolaawokunle\ExchangeRate\Http\Requests\ExchangeRateRequest;
use Omotolaawokunle\ExchangeRate\Http\Responses\ExchangeRateResponse;

class ExchangeRateController extends Controller
{
    public function getExchangeRate(ExchangeRateRequest $request, ExchangeRate $exchangeRate): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $amount = $validatedData['amount'];
            $currency = strtoupper($validatedData['currency']);

            $result = $exchangeRate->exchange($amount, $currency);
            if ($result > 0) {
                return ExchangeRateResponse::success(['amount' => $result]);
            }
            return ExchangeRateResponse::error("Currency {$currency} not found!");
        } catch (\Exception $e) {
            return ExchangeRateResponse::error($e->getMessage());
        }
    }
}
