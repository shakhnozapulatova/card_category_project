<?php

namespace App\Http\Requests;

use App\DataTransferObjects\ProductDto;
use App\Enums\ProductStatus;

class ProductUpdateRequest extends JsonRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
        ];
    }

    public function getDto(): ProductDto
    {
        return new ProductDto(
            $this->get('name'),
            ProductStatus::DRAFT,
            null
        );
    }
}
