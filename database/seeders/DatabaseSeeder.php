<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Product::factory(30)->create();

        \App\Models\ProductAttribute::factory()->create([
            'name' => 'Категория',
            'value' => 'category',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'password' => bcrypt('qwerty123'),
            'email' => 'admin@gmail.com'
        ]);

        \App\Models\ProductAttribute::factory()->create([
            'name' => 'Код ATX',
            'value' => 'atx',
        ]);

        \App\Models\ProductAttribute::factory()->create([
            'name' => 'Код ATX (старое значение)',
            'value' => 'old_atx',
        ]);

        \App\Models\ProductAttribute::factory()->create([
            'name' => 'Страна Производитель',
            'value' => 'country_producer',
        ]);

        \App\Models\ProductAttribute::factory()->create([
            'name' => 'Страна Производитель (старое значение)',
            'value' => 'old_country_producer',
        ]);

        \App\Models\ProductAttribute::factory()->create([
            'name' => 'МНН',
            'value' => 'mnn',
        ]);

        \App\Models\ProductAttribute::factory()->create([
            'name' => 'МНН (старое значение)',
            'value' => 'old_mnn',
        ]);

    }
}
