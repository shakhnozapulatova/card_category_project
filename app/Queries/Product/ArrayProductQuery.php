<?php


namespace App\Queries\Product;


use Illuminate\Support\Collection;

class ArrayProductQuery implements ProductQuery
{
    private $productStorage = [];

    private $editorId;

    private $productId;

    public function __construct(array $products)
    {
        $this->productStorage = $products;
    }

    public function byEditorId(int $editorId): self
    {
        $this->editorId = $editorId;
        return $this;
    }

    public function byId(int $productId): self
    {
        $this->productId = $productId;
        return $this;
    }

    public function execute(): array
    {
        $result = collect();

        if ($this->editorId) {
            collect($this->productStorage)->where('editor_id', $this->editorId)
                ->each(function ($product) use ($result) {
                    $result->add($product);
                });
        }

        if ($this->productId) {
            collect($this->productStorage)->where('id', $this->productId)
                ->each(function ($product) use ($result) {
                    $result->add($product);
                });
        }

        return $result->toArray();
    }
}
