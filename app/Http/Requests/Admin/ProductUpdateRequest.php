<?php

namespace App\Http\Requests\Admin;

use App\DataTransferObjects\ProductDto;
use App\Enums\ProductStatus;
use App\Http\Requests\JsonRequest;

class ProductUpdateRequest extends JsonRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'status' => ['nullable', 'in:' . implode(',', ProductStatus::getStatuses()),],
            'editor_id' => ['nullable', 'integer']
        ];
    }

    public function getDto(): ProductDto
    {
        return new ProductDto(
            $this->get('name'),
            $this->get('status'),
            $this->get('editor_id'),
        );
    }
}
