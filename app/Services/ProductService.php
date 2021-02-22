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
        // Todo remove old name column
        return Product::create([
            'name' => $dto->getName(),
            'old_name' => $dto->getName(),
            'editor_id' => $dto->getEditorId(),
            'status' => $dto->getStatus(),
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
            'name' => $dto->getName(),
            'editor_id' => $dto->getEditorId(),
            'status' => $dto->getStatus(),
        ]);

        $product->fresh();

        return $product;
    }

    public function delete(int $id): int
    {
        return Product::destroy($id);
    }
}
