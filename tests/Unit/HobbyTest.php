<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Hobby;

class HobbyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fetch_formated_description()
    {
        $hobby = create(Hobby::class, [
            'description' => 'Test1, Test2, Test3'
        ]);

        $descriptions = $hobby->getDescription();

        $this->assertEquals(3, count($descriptions));
        $this->assertEquals('Test1', $descriptions[0]);
    }

    /** @test */
    public function it_can_fetch_only_visible_hobbies()
    {
        $visibleHobby = create(Hobby::class, [
            'visible' => 1
        ]);

        $invisibleHobby = create(Hobby::class, [
            'visible' => 0
        ]);

        $hobbies = Hobby::visible()->get();

        $this->assertEquals(1, $hobbies->count());
        $this->assertEquals($visibleHobby->name, $hobbies[0]->name);
    }
}
