<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Pagination;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductUpdateRequest as AdminUpdateProductsRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', Pagination::DEFAULT_PER_PAGE);

        $query = $request->with ? Product::with($request->with) : Product::query();

        $products = $query->when($request->name, function ($query, $name) {
            $query->where('name', $query, $name);
        })
            ->paginate($perPage);

        return ProductResource::collection($products);
    }

    public function show($id)
    {
        //
    }

    public function update(int $id, AdminUpdateProductsRequest $request, ProductService $service): ProductResource
    {
        $product = $service->update($id, $request->getDto());

        return ProductResource::make($product);
    }

    public function destroy(int $id, ProductService $service): \Illuminate\Http\JsonResponse
    {
        $service->delete($id);
        return response()->json(['message' => 'Продукт удален']);
    }
}
