<?php

namespace Tests\Feature;

use App\Enums\ProductStatus;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\Feature\Traits\CreateUser;
use Tests\TestCase;

class AdminProductControllerTest extends TestCase
{
    use RefreshDatabase;
    use CreateUser;

    private $product;
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = Product::factory()->create([
            'status' => ProductStatus::DRAFT,
            'editor_id' => null
        ]);

        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'api'
        ]);

        $this->user = User::factory()->create();

        $this->user->assignRole($role);

        $this->token = auth()->tokenById($this->user->id);
    }

    public function updateProductRequest(array $data): \Illuminate\Testing\TestResponse
    {
        return $this->put(route('admin.products.update', $this->product->id),
            $data,
            [
                'Authorization' => 'Bearer ' . $this->token
            ]
        );
    }

    public function test_admin_can_change_product_status()
    {
        $response = $this->updateProductRequest(
            [
                'name' => $this->product->name,
                'status' => ProductStatus::PUBLISHED
            ]
        );

        $product = Product::find($this->product->id);

        $response->assertOk();

        $this->assertEquals(ProductStatus::PUBLISHED, $product->status);
    }

    public function test_admin_can_assign_product_editor()
    {
        $response = $this->updateProductRequest([
            'name' => $this->product->name,
            'editor_id' => $this->user->id
        ]);

        $product = Product::find($this->product->id);

        $response->assertOk();

        $this->assertEquals($this->user->id, $product->editor_id);
    }

    public function test_admin_can_delete_product()
    {
        $response = $this->delete(route('admin.products.destroy', $this->product->id),
            [],
            [
                'Authorization' => 'Bearer ' . $this->token
            ]
        );

        $response->assertOk();
        $this->assertDatabaseCount('products', 0);
        $this->assertDatabaseMissing('products', $this->product->toArray());
    }
}
