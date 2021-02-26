<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'editor_id' => $this->editor_id,
            'editor' => $this->whenLoaded('editor'),
            'status' => $this->status,
            'data' => new ProductDataCollection($this->whenLoaded('data')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
