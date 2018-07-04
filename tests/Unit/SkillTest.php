<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Skill;

class SkillTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fetch_visible_skills_according_to_their_categories()
    {

        $category = create('App\Category', ['type' => Skill::class]);

        create(Skill::class, [
            'category_id' => $category->id
        ], 2);

        $categoryWithSkills = Skill::getVisibleSkills();

        $this->assertEquals(1, $categoryWithSkills->count());
        $this->assertInstanceOf('App\Category', $categoryWithSkills[0]);

        $this->assertEquals(2, $categoryWithSkills[0]->skills->count());
        $this->assertInstanceOf(Skill::class, $categoryWithSkills[0]->skills[0]);
    }

    /** @test */
    public function it_belongs_to_many_realisations()
    {

        $skill = create(Skill::class);
        $realisations = create('App\Realisation', [],2);

        $realisations[0]->skills()->sync([$skill->id]);
        $realisations[1]->skills()->sync([$skill->id]);

        $this->assertEquals(2, $skill->realisations->count());
        $this->assertInstanceOf('App\Realisation', $skill->realisations[0]);
    }

    /** @test */
    public function it_belongs_to_a_category()
    {
        $category = create('App\Category', ['type' => Skill::class]);
        $skill = create(Skill::class, [
            'category_id' => $category->id
        ]);

        $this->assertEquals(1, $skill->category->count());
        $this->assertInstanceOf('App\Category', $skill->category);

    }

    /** @test */
    public function it_belongs_to_a_level()
    {
        $level = create('App\Level');
        $skill = create(Skill::class, [
            'level_id' => $level->id
        ]);

        $this->assertEquals(1, $skill->level->count());
        $this->assertInstanceOf('App\Level', $skill->level);
    }

    /** @test */
    public function it_fetch_formated_description_for_the_view()
    {

        $skill = create(Skill::class, [
            'description' => 'Test1, test2, test3'
        ]);

        $description = $skill->getDescriptions();

        $this->assertEquals(3, count($description));
        $this->assertEquals('Test1', $description[0]);
    }


}
