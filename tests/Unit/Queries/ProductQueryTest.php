<?php

namespace Tests\Unit\Queries;

use App\Queries\Product\ArrayProductQuery;
use App\Queries\Product\ProductQuery;
use PHPUnit\Framework\TestCase;

class ProductQueryTest extends TestCase
{
    /**
     * @var array
     */
    private $products;
    /**
     * @var ArrayProductQuery
     */
    private $productQuery;

    public function setUp(): void
    {
        parent::setUp();

        $this->products = [
            [
                'id' => 1,
                'editor_id' => 1,
                'name' => 'Product name',
            ],
            [
                'id' => 2,
                'editor_id' => 1,
                'name' => 'Product2 name',
            ],
        ];

        $this->productQuery = app()->instance(ProductQuery::class, new ArrayProductQuery($this->products));
    }

    public function test_can_search_by_editor_id()
    {
        $result = $this->productQuery->byEditorId(1)->execute();

        $this->assertEquals($this->products, $result);

        $this->assertCount(2, $result);
    }

    public function test_can_find_by_id()
    {
        $result = $this->productQuery->byId(1)->execute();

        $this->assertEquals($this->products[0], $result[0]);

        $this->assertCount(1, $result);
    }
}
