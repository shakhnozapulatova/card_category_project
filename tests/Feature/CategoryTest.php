<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    private $jwtToken;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->jwtToken = auth()->tokenById($user->id);
    }



    public function test_index()
    {
        $response = $this->get(route('category.index'), [
            'Authorization' => 'Bearer ' . $this->jwtToken
        ]);

        $response->assertJsonStructure(['data' => []]);
    }

    public function test_store()
    {
        $data = [
            'name' => 'Store name',
            'slug' => 'Store_name'
        ];

        $this->post(route('category.store'),
            $data,
            [
                'Authorization' => 'Bearer ' . $this->jwtToken
            ]
        );

        $this->assertDatabaseHas('categories', $data);
    }

    public function test_store_with_missing_data()
    {
        $response = $this->post(route('category.store'),
            [],
            [
                'Authorization' => 'Bearer ' . $this->jwtToken
            ]
        );

        $response->assertStatus(422);
    }

    public function test_update()
    {
        $category = Category::factory()->create();

        $response = $this->put(route('category.update', $category->id),
            [
                'name' => 'Update name',
                'slug' => 'update_name'
            ],
            [
                'Authorization' => 'Bearer ' . $this->jwtToken
            ]
        );

        $response->assertSeeText('Category updated');
    }

    public function test_show()
    {
        $category = Category::factory()->create();

        $response = $this->get(route('category.show', $category->id),
            [
                'Authorization' => 'Bearer ' . $this->jwtToken
            ]
        );

        $response->assertOk();
    }

    public function test_delete()
    {
        $category = Category::factory()->create();

        $this->delete(route('category.destroy', $category->id),
            [],
            [
                'Authorization' => 'Bearer ' . $this->jwtToken
            ]
        );

        $this->assertDeleted($category);
    }
}
