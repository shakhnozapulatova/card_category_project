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

    public function store(ProductRequest $request): ProductResource
    {
        $product = Product::create($request->validated());

        return ProductResource::make($product);
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
        $product->load('data');
        return response()->json(['form' => $form->fill($product)->get()]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        $product->fresh();

        return ProductResource::make($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Продукт удален']);
    }
}
