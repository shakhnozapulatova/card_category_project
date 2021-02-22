<?php


namespace App\Services;


use App\DataTransferObjects\ProductDataDto;
use App\Models\Product;

final class ProductDataService
{
    /**
     * @param Product $product
     * @return mixed
     */
    public function deleteData(Product $product)
    {
        return $product->data()->delete();
    }

    /**
     * @param Product $product
     * @param ProductDataDto[] $dtos
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function create(Product $product, array $dtos): \Illuminate\Database\Eloquent\Collection
    {
        $data = $this->formatData($dtos);

        return $product->data()->createMany($data);
    }

    /**
     * @param Product $product
     * @param ProductDataDto[] $dtos
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function update(Product $product, array $dtos): \Illuminate\Database\Eloquent\Collection
    {
        $this->deleteData($product);

        return $this->create($product, $dtos);
    }
    /**
     * @param ProductDataDto[] $dtos
     * @return array
     */
    private function formatData(array $dtos): array
    {
        $result = [];

        if (empty($dtos)) {
            return $result;
        }

        foreach ($dtos as $dto) {
            $result[] = [
                'name' => $dto->getName(),
                'value' => $dto->getValue()
            ];
        }

        return $result;
    }
}
