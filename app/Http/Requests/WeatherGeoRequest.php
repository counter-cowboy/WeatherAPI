<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeatherGeoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'lat' => ['required|string'],
            'lon' => ['required|string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
