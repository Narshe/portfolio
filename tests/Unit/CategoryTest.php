<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;

use App\Category;
use App\Skill;
use App\Hobby;
use App\Realisation;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_return_the_categories_with_the_data_associated()
    {

        $category = create('App\Category', ['type' => Skill::class]);
        $skills = create('App\Skill', ['category_id' => $category->id], 2 );

        $data =  Category::getCategories(['skills'], Skill::class);

        $this->assertEquals($data[0]->name, $skills[0]->category->name);
        $this->assertEquals($data[0]->skills[0]->name, $skills[0]->name);
        $this->assertEquals($data[0]->skills[1]->name, $skills[1]->name);
        $this->assertCount(2, $data[0]->skills);

    }

    /** @test */
    public function it_has_visible_skills()
    {
        $this->assertVisible(Skill::class, 'visibleSkills');
    }

    /** @test */
    public function it_has_visible_realisations()
    {
        $this->assertVisible(Realisation::class, 'visibleRealisations');
    }

    /** @test */
    public function it_has_visible_hobbies()
    {
        $this->assertVisible(Hobby::class, 'visibleHobbies');
    }

    /** @test */
    public function it_has_skills()
    {
        $this->assertHasManyRelation(Skill::class, 'skills');
    }

    /** @test */
    public function it_has_realisations()
    {
        $this->assertHasManyRelation(Realisation::class, 'realisations');
    }

    /** @test */
    public function it_has_hobbies()
    {
        $this->assertHasManyRelation(Hobby::class, 'hobbies');
    }

    private function assertVisible($modelName, $prop)
    {
        $category = create('App\Category', ['type' => Skill::class]);
        create($modelName, ['visible' => 0, 'category_id' => $category->id]);

        $visibleModel = create($modelName, ['category_id' => $category->id]);

        $this->assertContains($visibleModel->name, $category->$prop->toArray()[0]);
        $this->assertCount(1, $category->$prop);
    }

    private function assertHasManyRelation($modelName, $prop)
    {
        $category = create('App\Category', ['type' => Realisation::class]);
        $model = create($modelName, ['category_id' => $category->id]);

        $this->assertInstanceOf($modelName, $category->$prop[0]);

    }
}
