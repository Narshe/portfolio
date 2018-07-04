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

        $skills = create('App\Skill', [], 2 );

        $categories =  Category::getCategories('skills',[], Skill::class);

        $this->assertCount(2, $categories);
        $this->assertCount(1, $categories[0]->skills);

    }

    /** @test */
    public function it_has_visible_skills()
    {
        $this->assertVisible(Skill::class, 'skills');
    }

    /** @test */
    public function it_has_visible_realisations()
    {
        $this->assertVisible(Realisation::class, 'realisations');
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


    private function assertVisible($modelName, $prop)
    {
        $category = create('App\Category', ['type' => $modelName]);
        create($modelName, ['visible' => 0, 'category_id' => $category->id]);

        $visibleModel = create($modelName, ['category_id' => $category->id]);

        $this->assertContains($visibleModel->name, $category->$prop->toArray()[0]);
        $this->assertCount(1, $category->$prop);
    }

    private function assertHasManyRelation($modelName, $prop)
    {
        $category = create('App\Category', ['type' => $modelName]);
        $model = create($modelName, ['category_id' => $category->id]);

        $this->assertInstanceOf($modelName, $category->$prop[0]);

    }
}
