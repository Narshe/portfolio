<?php

namespace Tests\Feature\Levels;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowLevelsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_fetch_all_categories()
    {
        $levels = create('App\Level', [],2);

        $response = $this->get(route('Levels'));

        $response
            ->assertStatus(200)
            ->assertSee($levels[0]->name)
            ->assertSee($levels[1]->name)
        ;
    }

}
