<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Psy\Util\Json;

class ProductRequest extends JsonRequest
{
    public function rules() : array
    {
        return [
            'name' => ['required'],
            'editor_id' => ['required', 'exists:users,id'],
            'status' => ['nullable'],
        ];
    }
}
