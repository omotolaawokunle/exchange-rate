<?php

namespace Omotolaawokunle\ExchangeRate\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExchangeRateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'amount' => 'required|numeric',
            'currency' => 'required|string',
        ];
    }
}
