<?php


namespace App\Services;


use App\Models\Product;

class ProductDataService
{
    /**
     * @param Product $product
     * @return mixed
     */
    public function deleteData(Product $product)
    {
        return $product->data()->delete();
    }

    public function saveData(Product $product, array $data): \Illuminate\Database\Eloquent\Collection
    {
        $data = $this->formatData($data);
        return $product->data()->createMany($data);
    }

    private function formatData(array $data): array
    {
        return collect($data)->map(function ($value, $key) {
            return [
                'name' => $key,
                'value' => $value
            ];
        })
            ->values()
            ->toArray();
    }
}
