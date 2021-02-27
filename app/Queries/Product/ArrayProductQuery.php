<?php


namespace App\Queries\Product;


use Illuminate\Support\Collection;

class ArrayProductQuery implements ProductQuery
{
    private $productStorage = [];

    private $editorId;

    private $productId;
    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $name;

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

    public function byStatus(string $status): ArrayProductQuery
    {
        $this->status = $status;

        return $this;
    }

    public function byName(string $name): ArrayProductQuery
    {
        $this->name = $name;

        return $this;
    }

    public function execute(): array
    {
        $result = collect($this->productStorage)
            ->when($this->editorId, function ($productStorage) {
                return $productStorage->where('editor_id', $this->editorId);
            })
            ->when($this->productId, function ($productStorage) {
                return $productStorage->where('id', $this->productId);
            })
            ->when($this->status, function ($productStorage) {
                return $productStorage->where('status', $this->status);
            })
            ->when($this->name, function ($productStorage) {
                return $productStorage->filter(function($item) {
                    if (strpos($this->name, $item['name']) !== false) {
                        return $item;
                    }
                    return [];
                });
            });

        return $result->toArray();
    }
}
