<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Traits\CreateUser;
use Tests\TestCase;

class ProductDataControllerTest extends TestCase
{
    use RefreshDatabase;
    use CreateUser;

    private $product;

    public function setUp(): void
    {
        parent::setUp();

        $this->createUser();

        $this->product = Product::factory()->create();
    }

    private function makeRequest(string $method, string $url, array $data): \Illuminate\Testing\TestResponse
    {
        return $this->{$method}(
            $url,
            $data,
            [
                'Authorization' => 'Bearer ' . $this->token
            ]
        );
    }

    public function test_store_product_meta_data()
    {
        $response = $this->makeRequest('post', route('product-data.store', $this->product->id), [
            'data' => [
                'atx' => 'atx1',
                'mnn' => 'mnn2',
                'country_producer' => 'country_producer3',
                'category' => 2,
            ],
        ]);

        $response->assertCreated();

        $this->assertDatabaseCount('product_data', 4);
    }

    public function test_update_product_meta_data()
    {
        $response = $this->makeRequest('put', route('product-data.update', $this->product->id), [
            'data' => [
                'atx' => 'atx2',
                'mnn' => 'mnn3',
                'country_producer' => 'country_producer4',
                'category' => 3,
            ],
        ]);

        $response->assertOk();

        $this->assertDatabaseCount('product_data', 4);
    }
}
