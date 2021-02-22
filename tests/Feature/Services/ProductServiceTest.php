<?php

namespace Tests\Feature\Services;

use App\DataTransferObjects\ProductDto;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    private $table = 'products';
    /**
     * @var ProductService
     */
    private $productService;

    public function setUp(): void
    {
        parent::setUp();

        $this->productService = new ProductService();
    }

    public function test_can_create_product_successfully()
    {
        $dto = new ProductDto(
            'Product name',
            'status',
            1
        );

        $product = $this->productService->create($dto);

        $this->assertDatabaseHas($this->table, $product->toArray());
        $this->assertDatabaseCount($this->table, 1);
    }

    public function test_can_update_product_successfully()
    {
        $product = Product::factory()->create();

        $updatedData = [
            'name' => 'Updated Product Name',
            'editor_id' => 2,
            'status' => 'published'
        ];

        $dto = new ProductDto(
            $updatedData['name'],
            $updatedData['status'],
            $updatedData['editor_id']
        );

        $this->productService->update($product->id, $dto);

        $this->assertDatabaseHas($this->table, $updatedData);
        $this->assertDatabaseCount($this->table, 1);
    }

    public function test_expects_exception_when_try_update_non_existing_model()
    {
        $dto = new ProductDto(
            'Product name',
            'status',
            1
        );

        $this->expectException(ModelNotFoundException::class);

        $this->productService->update(1, $dto);
    }
}
