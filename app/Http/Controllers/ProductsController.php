<?php

namespace App\Http\Controllers;

use App\Enums\Pagination;
use App\Enums\ProductStatus;
use App\Forms\ProductForm;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $perPage = $request->get('perPage', Pagination::DEFAULT_PER_PAGE);
        $products = Product::query()
            ->when($request->name, function ($query, $name) {
                $query->where('name', $query, $name);
            })
            ->paginate($perPage);

        return ProductResource::collection($products);
    }

    public function store(ProductRequest $request): \Illuminate\Http\JsonResponse
    {
        Product::create($request->validated());

        return response()->json(['message' => 'Продукт добавлен']);
    }

    public function create(ProductForm $form): \Illuminate\Http\JsonResponse
    {
        return response()->json(['form' => $form->get()]);
    }

    public function show(Product $product): ProductResource
    {
        return ProductResource::make($product);
    }

    public function edit(Product $product, ProductForm $form)
    {
        return response()->json(['form' => $form->fill($product)->get()]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return response()->json(['message' => 'Продукт обновлен']);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Продукт удален']);
    }
}
