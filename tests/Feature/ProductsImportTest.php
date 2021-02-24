<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductsImportTest extends TestCase
{
    use RefreshDatabase;

    private $token;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $this->token = auth()->tokenById($user->id);
        $this->seed();
    }

    public function test_products_import()
    {
        $response = $this->post(route('import.products'),
            [
                'file_path' => public_path('products test.xlsx')
            ],
            [
                'Authorization' => 'Bearer ' . $this->token
            ]
        );

        $response->assertOk();
        $response->assertSee('Import finished');
        $this->assertDatabaseCount('products', 2);
        $this->assertDatabaseCount('product_data', 14);
    }
}
