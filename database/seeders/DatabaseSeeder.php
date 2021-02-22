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
        \App\Models\Attribute::factory()->create([
            'name' => 'Категория',
            'value' => 'category',
        ]);

        \App\Models\Attribute::factory()->create([
            'name' => 'Код ATX',
            'value' => 'atx',
        ]);

        \App\Models\Attribute::factory()->create([
            'name' => 'Код ATX (старое значение)',
            'value' => 'old_atx',
        ]);

        \App\Models\Attribute::factory()->create([
            'name' => 'Страна Производитель',
            'value' => 'country_producer',
        ]);

        \App\Models\Attribute::factory()->create([
            'name' => 'Страна Производитель (старое значение)',
            'value' => 'old_country_producer',
        ]);

        \App\Models\Attribute::factory()->create([
            'name' => 'МНН',
            'value' => 'mnn',
        ]);

        \App\Models\Attribute::factory()->create([
            'name' => 'МНН (старое значение)',
            'value' => 'old_mnn',
        ]);
    }
}
