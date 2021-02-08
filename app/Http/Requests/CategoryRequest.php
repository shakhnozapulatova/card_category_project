<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends JsonRequest
{
    public function rules() : array
    {
        return [
            'name' => ['required', 'string'],
            'order' => ['nullable', 'integer'],
            'slug' => ['required', 'string', 'alpha_dash'],
            'parent_id' => ['nullable', 'integer']
        ];
    }
}
