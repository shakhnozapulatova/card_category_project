<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductDataRequest extends JsonRequest
{
    public function rules() : array
    {
        return [
            'data.*' => ['nullable']
        ];
    }
}
