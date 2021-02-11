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

    private $category;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->category = Category::factory()->create();
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


    public function test_category_create_form()
    {
        $response = $this->get(route('category.create'), [
            'Authorization' => 'Bearer ' . $this->jwtToken
        ]);

        $response->assertJsonStructure(['form']);
    }

    public function test_category_update_form()
    {
        $response = $this->get(route('category.edit', $this->category->id), [
            'Authorization' => 'Bearer ' . $this->jwtToken
        ]);

        $response->assertJsonStructure(['form']);
    }

    public function test_update()
    {
        $response = $this->put(route('category.update', $this->category->id),
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
        $response = $this->get(route('category.show', $this->category->id),
            [
                'Authorization' => 'Bearer ' . $this->jwtToken
            ]
        );

        $response->assertOk();
    }

    public function test_delete()
    {
        $this->delete(route('category.destroy', $this->category->id),
            [],
            [
                'Authorization' => 'Bearer ' . $this->jwtToken
            ]
        );

        $this->assertDeleted($this->category);
    }
}
