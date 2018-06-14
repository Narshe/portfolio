<?php

namespace Tests\Feature\Skills;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowSkillsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_fetch_all_skills()
    {
        $skills = create('App\Skill', [],2);

        $response = $this->get(route('Skills'));

        $response
            ->assertStatus(200)
            ->assertSee($skills[0]->name)
            ->assertSee($skills[1]->name)
        ;
    }

}
