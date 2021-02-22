<?php


namespace Services;


use App\DataTransferObjects\ProductDataDto;
use App\Models\Product;
use App\Services\ProductDataService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductDataServiceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private $product;
    /**
     * @var ProductDataServiceTest
     */
    private $service;

    private $productData;

    public function setUp() : void
    {
        parent::setUp();
        $this->product = Product::factory()->create();
        $this->service = new ProductDataService();
        $this->productData = [
            new ProductDataDto('atx', 'ACAC1'),
            new ProductDataDto('category', 'Category'),
        ];
    }

    public function test_logged_in_user_can_create_product_data()
    {
        $this->service->create($this->product, $this->productData);

        $this->assertDatabaseCount('product_data', 2);
    }


    public function test_can_delete_product_data()
    {
        $this->service->create($this->product, $this->productData);

        $this->service->deleteData($this->product);

        $this->assertEquals([], $this->product->data->toArray());
    }
}
