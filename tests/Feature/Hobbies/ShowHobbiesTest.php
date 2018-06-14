<?php

namespace Tests\Feature\Hobbies;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowHobbiesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_fetch_all_hobbies()
    {
        $hobbies = create('App\Hobby', [],2);

        $response = $this->get(route('Hobbies'));

        $response
            ->assertStatus(200)
            ->assertSee($hobbies[0]->name)
            ->assertSee($hobbies[1]->name)
        ;
    }

}
