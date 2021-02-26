<?php


namespace App\Queries\Product;

use App\Models\Product;

class EloquentProductQueries implements ProductQuery
{
    private $editorId;

    private $productId;

    private $with;

    public function __construct(array $with = [])
    {
        $this->with = $with;
    }

    public function byEditorId(int $editorId = null): self
    {
        $this->editorId = $editorId;
        return $this;
    }

    public function byId(int $productId = null): self
    {
        $this->productId = $productId;
        return $this;
    }

    public function execute($perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = $this->getQuery();

        $query
            ->when($this->editorId, function ($query) {
                $query->where('editor_id', $this->editorId);
            })
            ->when($this->productId, function ($query) {
                $query->where('id', $this->productId);
            });

        return $query->paginate($perPage);
    }

    private function getQuery()
    {
        return $this->with ? Product::with($this->with) : Product::query();
    }
}
