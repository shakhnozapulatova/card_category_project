<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeOptionRequest;
use App\Models\AttributeOption;
use App\Services\HierarchicalFormatter;

class AttributeOptionsController extends Controller
{
    /**
     * @var HierarchicalFormatter
     */
    private $formatter;

    public function __construct(HierarchicalFormatter $formatter)
    {
        $this->formatter = $formatter;
    }

    public function index(AttributeOptionRequest $request)
    {
        $attributeName = $request->validated()['attribute'];

        // Todo move to cahe service
        $cacheKey = "options-{$attributeName}";

        if ($attributes = \Cache::get($cacheKey)) {
            return response()->json(['data' => $attributes]);
        }

        $attributes = AttributeOption::where('attribute', $attributeName)
            ->get()
            ->toArray();

        $attributes = $this->formatter->formatRecursively($attributes);

        \Cache::put($cacheKey, $attributes);

        return response()->json(['data' => $attributes]);
    }
}
