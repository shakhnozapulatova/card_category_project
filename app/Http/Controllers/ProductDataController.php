<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductDataRequest;
use App\Models\Product;
use App\Services\ProductDataService;

class ProductDataController extends Controller
{
    /**
     * @var ProductDataService
     */
    private $productDataService;

    public function __construct(ProductDataService $productDataService)
    {
        $this->productDataService = $productDataService;
    }

    public function store(Product $product, ProductDataRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->productDataService->create($product, $request->getDto());

        return response()->json([], 201);
    }

    public function update(Product $product, ProductDataRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->productDataService->update($product, $request->getDto());

        return response()->json([]);
    }
}
