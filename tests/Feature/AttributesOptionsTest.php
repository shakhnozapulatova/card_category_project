<?php

namespace Tests\Feature;

use App\Models\AttributeOption;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CreateUser;
use Tests\TestCase;

class AttributesOptionsTest extends TestCase
{
    use RefreshDatabase;
    use CreateUser;

    public function setUp() : void
    {
        parent::setUp();
        $this->createUser();

    }

    public function test_user_can_view_options_by_attribute_name()
    {
        $option = AttributeOption::factory()->create([
            'attribute' => 'atx',
            'parent_id' => null
        ]);

        $option2 = AttributeOption::factory()->create([
            'attribute' => 'atx',
            'parent_id' => $option->id
        ]);

        $response = $this->get(route('attributes-option.index', ['attribute' => 'atx']), [
            'Authorization' => 'Bearer ' . $this->token
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'value',
                    'children'
                ]
            ]
        ]);
    }
}
