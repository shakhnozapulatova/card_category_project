<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends JsonRequest
{
    public function rules() : array
    {
        return [
            'name' => ['required', 'string'],
            'parent_id' => ['nullable', 'integer'],
            'order' => ['nullable', 'integer'],
        ];
    }
}
