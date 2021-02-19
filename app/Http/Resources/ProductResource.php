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
            'editor' => $this->whenLoaded('editor'),
            'old_name' => $this->old_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
