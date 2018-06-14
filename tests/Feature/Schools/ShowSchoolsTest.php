<?php

namespace Tests\Feature\Schools;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowSchoolsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_fetch_all_categories()
    {
        $schools = create('App\School', [],2);

        $response = $this->get(route('Schools'));

        $response
            ->assertStatus(200)
            ->assertSee($schools[0]->name)
            ->assertSee($schools[1]->name)
        ;
    }

}
