<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    private $token;

    private $product;
    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->token = auth()->tokenById($this->user->id);

        $this->product = Product::factory()->create();
    }

    public function test_can_logged_in_user_view_products()
    {
        $response = $this->get(route('products.index'), [
            'Authorization' => 'Bearer ' . $this->token
        ]);

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'old_name',
                    'created_at',
                    'updated_at'
                ]
            ]
        ]);
    }

    public function test_guest_cant_view_products()
    {
        $response = $this->get(route('products.index'));

        $response->assertUnauthorized();
    }

    public function test_logged_in_user_can_store_product()
    {
        $productData = [
            'name' => 'Create name',
            'editor_id' => $this->user->id,
            'status' => 'draft'
        ];

        $response = $this->post(route('products.store'),
            $productData,
            [
                'Authorization' => 'Bearer ' . $this->token
            ]);

        $response->assertCreated();

        $this->assertDatabaseHas('products', $productData);
    }

    public function test_show_logged_in_user_product()
    {
        $response = $this->get(route('products.show', $this->product->id),
            [
                'Authorization' => 'Bearer ' . $this->token
            ]);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'old_name',
                'created_at',
                'updated_at'
            ]
        ]);
    }

    public function test_update_by_logged_in_user()
    {
        $response = $this->put(route('products.update', $this->product->id),
            [
                'name' => 'New name for created product',
                'editor_id'  => $this->user->id,
                'status' => 'pending'
            ],
            [
                'Authorization' => 'Bearer ' . $this->token
            ]);

        $response->assertOk();

        $this->assertDatabaseHas('products', [
            'name' => 'New name for created product',
            'editor_id'  => $this->user->id,
            'status' => 'pending',
            'created_at' => $this->product->created_at,
            'updated_at' => $this->product->updated_at,
        ]);
    }

    public function test_delete_by_logged_in_user()
    {
        $response = $this->delete(route('products.destroy', $this->product->id),
            [],
            [
                'Authorization' => 'Bearer ' . $this->token
            ]);

        $response->assertOk();

        $this->assertDatabaseMissing('products', $this->product->toArray());
    }

    public function test_create_product_form()
    {
        $response = $this->get(route('products.create'),
            [
                'Authorization' => 'Bearer ' . $this->token
            ]);

        $response->assertOk();
        $response->assertJsonStructure(['form']);
    }

    public function test_edit_product_form()
    {
        $response = $this->get(route('products.edit', $this->product->id),
            [
                'Authorization' => 'Bearer ' . $this->token
            ]);

        $response->assertOk();
        $response->assertJsonStructure(['form']);
    }
}
