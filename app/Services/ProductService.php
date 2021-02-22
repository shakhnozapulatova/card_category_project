<?php


namespace App\Services;


use App\DataTransferObjects\ProductDto;
use App\Models\Product;

class ProductService
{
    /**
     * @param ProductDto $dto
     * @return Product|\Illuminate\Database\Eloquent\Model
     */
    public function create(ProductDto $dto)
    {
        return Product::create([
            'name' => $dto->name,
            'old_name' => $dto->name,
            'editor_id' => $dto->editor_id,
            'status' => $dto->status,
        ]);
    }

    /**
     * @param int $id
     * @param ProductDto $dto
     * @return Product|Product[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, ProductDto $dto)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $dto->name,
            'editor_id' => $dto->editor_id,
            'status' => $dto->status,
        ]);

        $product->fresh();

        return $product;
    }
}
