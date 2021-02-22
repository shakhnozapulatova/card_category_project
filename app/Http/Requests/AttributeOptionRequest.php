<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeOptionRequest extends JsonRequest
{
    public function rules() : array
    {
        return [
            'attribute' => ['required', 'string'],
        ];
    }

    public function getDto()
    {
        // TODO: Implement getDto() method.
    }
}
