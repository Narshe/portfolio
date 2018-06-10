<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_fetch_all_categories()
    {
        $categories = create('App\Category', [],2);

        $response = $this->get(route('Categories'));

        $response
            ->assertStatus(200)
            ->assertSee($categories[0]->name)
            ->assertSee($categories[1]->name)
        ;
    }

}
