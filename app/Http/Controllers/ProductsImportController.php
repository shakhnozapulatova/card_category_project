<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductsImportController extends Controller
{
    public function import()
    {
        $filePath = \request()->get('file_path');

        Excel::import(new ProductsImport(), $filePath);

        return response()->json(['message' => 'Import finished']);
    }
}
