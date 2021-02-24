<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductDataCollection extends ResourceCollection
{
    public function toArray($request) : array
    {
        return $this->collection->pluck('value', 'name')->toArray();
    }
}
