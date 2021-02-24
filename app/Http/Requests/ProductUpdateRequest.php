<?php

namespace App\Http\Requests;

use App\DataTransferObjects\ProductDto;
use App\Enums\ProductStatus;
use App\Rules\CanUserMakeStatusPublishedRule;

class ProductUpdateRequest extends JsonRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'status' => [
                'nullable',
                'in:' . implode(',', ProductStatus::getStatuses()),
                 new CanUserMakeStatusPublishedRule($this->user())
            ],
            'editor_id' => ['nullable', 'integer']
        ];
    }

    public function getDto(): ProductDto
    {
        return new ProductDto(
            $this->get('name'),
            $this->get('status', ProductStatus::DRAFT),
            $this->get('editor_id'),
        );
    }
}
