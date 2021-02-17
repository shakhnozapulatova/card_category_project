<?php

namespace App\Imports;

use App\Enums\ProductStatus;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $product = Product::create([
                'id' => $row['goodid'],
                'name' => $row['good'],
                'old_name' => $row['good'],
                'status' => ProductStatus::PENDING,
            ]);

            $product->data()->createMany([
                [
                    'name' => 'atx',
                    'value' => $row['kod_atx'] == 'NULL' ? null : $row['kod_atx']
                ],
                [
                    'name' => 'old_atx',
                    'value' => $row['kod_atx'] == 'NULL' ? null : $row['kod_atx']
                ],
                [
                    'name' => 'old_mnn',
                    'value' => $row['mezdunarodnoe_nazvanie_mnn'] == 'NULL' ? null : $row['mezdunarodnoe_nazvanie_mnn']
                ],
                [
                    'name' => 'mnn',
                    'value' => $row['mezdunarodnoe_nazvanie_mnn'] == 'NULL' ? null : $row['mezdunarodnoe_nazvanie_mnn']
                ],
                [
                    'name' => 'old_country_producer',
                    'value' => $row['producer']
                ],
                [
                    'name' => 'country_producer',
                    'value' => $row['producer']
                ],
            ]);
        }
    }
}
