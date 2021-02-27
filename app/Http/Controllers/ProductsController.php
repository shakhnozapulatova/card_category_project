<?php

namespace App\Http\Controllers;

use App\Enums\Pagination;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Queries\Product\ProductQuery;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * @var ProductQuery
     */
    private $productQuery;

    public function __construct(ProductQuery $productQuery)
    {
        $this->productQuery = $productQuery;
    }

    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $perPage = $request->get('perPage', Pagination::DEFAULT_PER_PAGE);

        $products = $this->productQuery
            ->byEditorId(auth()->id())
            ->byName($request->get('name'))
            ->byStatus($request->get('status'))
            ->execute($perPage);

        return ProductResource::collection($products);
    }


    public function show(int $id): ProductResource
    {
        $result  = $this->productQuery->byId($id)->execute();
        $product = $result->first();

        $this->authorize('view', $product);

        return ProductResource::make($product);
    }

    public function update(int $id, ProductUpdateRequest $request, ProductService $service): ProductResource
    {
        $productDto = $request->getDto();

        $this->authorize('update', [Product::class, $productDto->getEditorId()]);

        $product = $service->update($id, $productDto);

        return ProductResource::make($product);
    }
}
