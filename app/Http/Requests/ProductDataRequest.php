<?php

namespace App\Http\Requests;

use App\DataTransferObjects\ProductDataDto;
use Illuminate\Foundation\Http\FormRequest;

class ProductDataRequest extends JsonRequest
{
    public function rules() : array
    {
        return [
            'data.*' => ['nullable']
        ];
    }

    /**
     * @return ProductDataDto[]
     */
    public function getDto(): array
    {
        $arr = [];

        if (empty($this->get('data'))) {
            return $arr;
        }

        foreach ($this->get('data') as $key => $value) {
            $arr[] = new ProductDataDto($key, $value);
        }

        return $arr;
    }
}
