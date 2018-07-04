<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class LevelTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function it_has_many_skills()
    {
        $level = create('App\Level');
        $skills = create('App\Skill', [
            'level_id' => $level->id
        ],2);

        $this->assertEquals(2, $level->skills->count());
        $this->assertInstanceOf('App\Skill', $level->skills[0]);
    }
}
