<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Pagination;
use App\Http\Controllers\Controller;
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

    public function index(Request $request)
    {
        $perPage = $request->get('perPage', Pagination::DEFAULT_PER_PAGE);

        $products = $this->productQuery->execute($perPage);

        return ProductResource::collection($products);
    }

    public function destroy(int $id, ProductService $service): \Illuminate\Http\JsonResponse
    {
        $service->delete($id);
        return response()->json(['message' => 'Продукт удален']);
    }
}
