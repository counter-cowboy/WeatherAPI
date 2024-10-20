<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeatherCityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'city' => ['required', 'string'],
            'limit'=>['string','sometimes']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
