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
        $this->productDataService->saveData($product, $request->validated()['data']);

        return response()->json([], 201);
    }

    public function update(Product $product, ProductDataRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->productDataService->deleteData($product);
        $this->productDataService->saveData($product, $request->validated()['data']);

        return response()->json([]);
    }
}
