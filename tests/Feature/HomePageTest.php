<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIsThereNotAnyErrorsOnHomePage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
