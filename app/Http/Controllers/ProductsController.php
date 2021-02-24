<?php

namespace App\Http\Controllers;

use App\Enums\Pagination;
use App\Forms\ProductForm;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $perPage = $request->get('perPage', Pagination::DEFAULT_PER_PAGE);

        $query = $request->with ? Product::with($request->with) : Product::query();

        $products = $query->when($request->name, function ($query, $name) {
            $query->where('name', $query, $name);
        })
            ->paginate($perPage);

        return ProductResource::collection($products);
    }


    public function show(Product $product): ProductResource
    {
        $this->authorize('view', $product);

        if ($with = \request()->with) {
            $product->load($with);
        }

        return ProductResource::make($product);
    }

    public function edit(Product $product, ProductForm $form): \Illuminate\Http\JsonResponse
    {
        $product->load('data');
        return response()->json(['form' => $form->fill($product)->get()]);
    }

    public function update(int $id, ProductUpdateRequest $request, ProductService $service): ProductResource
    {
        $productDto = $request->getDto();

        $this->authorize('update', [Product::class, $productDto->getEditorId()]);

        $product = $service->update($id, $productDto);

        return ProductResource::make($product);
    }
}
