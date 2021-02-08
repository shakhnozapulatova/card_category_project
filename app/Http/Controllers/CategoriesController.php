<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $categories = Category::query()
            ->when($request->get('name'), function ($query, $categoryName) {
                $query->where('name', 'like', "%$categoryName%");
            })
            ->when($request->get('parent_id'), function ($query, $parent_id) {
                $query->where('parent_id', $parent_id);
            })
            ->get();

        return CategoryResource::collection($categories);
    }

    public function store(CategoryRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();

        $category = new Category;

        $category->name = $validated['name'];
        $category->slug = $validated['slug'];
        $category->order = $validated['order'] ?? 0;

        $category->save();

        return response()->json(['message' => 'Category created'], 201);
    }


    public function show(Category $category): CategoryResource
    {
        return CategoryResource::make($category);
    }

    public function update(CategoryRequest $request, Category $category): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();

        $category->name = $validated['name'];
        $category->slug = $validated['slug'];
        $category->order = $validated['order'] ?? 0;

        $category->save();

        return response()->json(['message' => 'Category updated']);
    }


    public function destroy(Category $category): \Illuminate\Http\JsonResponse
    {
        try {
            $category->delete();
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json(['message' => 'Category Deleted']);
    }
}
