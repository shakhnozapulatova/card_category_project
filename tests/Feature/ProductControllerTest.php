<?php

namespace Tests\Feature;

use App\Enums\ProductStatus;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
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

        $this->user = User::factory()->create([
            'level_access' => 1,
        ]);

        $this->token = auth()->tokenById($this->user->id);

        $this->product = Product::factory()->create([
            'editor_id' => $this->user->id
        ]);
    }

    public function test_can_editor_view_products()
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

    public function test_editor_can_view_single_product()
    {
        $response = $this->get(route('products.show', $this->product->id),
            [
                'Authorization' => 'Bearer ' . $this->token
            ]);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'created_at',
                'updated_at'
            ]
        ]);
    }

    public function test_editor_can_update_product()
    {
        $response = $this->put(route('products.update', $this->product->id),
            [
                'name' => 'New name for created product',
                'status' => ProductStatus::DRAFT,
                'editor_id'  => $this->user->id,
            ],
            [
                'Authorization' => 'Bearer ' . $this->token
            ]);

        $response->assertOk();

        $this->assertDatabaseHas('products', [
            'name' => 'New name for created product',
            'editor_id'  => $this->user->id,
            'status' => ProductStatus::DRAFT,
            'created_at' => $this->product->created_at,
            'updated_at' => $this->product->updated_at,
        ]);
    }

    public function test_editor_cant_create_product()
    {
        $this->expectException(RouteNotFoundException::class);

        $this->delete(route('products.store'),
            [
                'name' => 'Create name'
            ],
            [
                'Authorization' => 'Bearer ' . $this->token
            ]);

    }

    public function test_editor_cant_delete_product()
    {
        $this->expectException(RouteNotFoundException::class);

        $this->delete(route('products.destroy', $this->product->id),
            [],
            [
                'Authorization' => 'Bearer ' . $this->token
            ]);

    }
}
