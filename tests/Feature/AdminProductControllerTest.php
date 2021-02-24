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

        $this->user = User::factory()->create([
            'level_access' => 2,
        ]);

        $this->token = auth()->tokenById($this->user->id);
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
