<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Psy\Util\Json;

class ProductRequest extends JsonRequest
{
    public function rules() : array
    {
        return [
            'category_id' => ['required', 'integer'],
            'name' => ['required'],
            'status' => ['nullable'],
            'order' => ['nullable', 'integer']
        ];
    }
}
