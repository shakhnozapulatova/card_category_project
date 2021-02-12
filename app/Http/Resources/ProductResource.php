<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category' => $this->whenLoaded('category'),
            'category_id' => $this->category_id,
            'name' => $this->name,
            'order' => $this->order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
