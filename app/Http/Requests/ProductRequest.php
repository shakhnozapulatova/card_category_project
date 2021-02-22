<?php

namespace App\Http\Requests;

use App\DataTransferObjects\ProductDto;

class ProductRequest extends JsonRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'editor_id' => ['required', 'exists:users,id'],
            'status' => ['nullable'],
        ];
    }

    public function getDto(): ProductDto
    {
        return new ProductDto(
            $this->get('name'),
            $this->get('editor_id'),
            $this->get('status')
        );
    }
}
