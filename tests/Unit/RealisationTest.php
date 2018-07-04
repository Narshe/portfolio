<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Realisation;

class RealisationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fetch_visible_realisations_according_to_their_categories()
    {
        $category = create('App\Category', [
            'type' => Realisation::class
        ]);

        $realisations = create(Realisation::class, [
            'category_id' => $category->id
        ], 2);

        $categoryWithRealisations = Realisation::getVisibleRealisations();

        $this->assertEquals(1, $categoryWithRealisations[0]->count());
        $this->assertInstanceOf('App\Category', $categoryWithRealisations[0]);

        $this->assertEquals(2, $categoryWithRealisations[0]->realisations[0]->count());
        $this->assertInstanceOf(Realisation::class, $categoryWithRealisations[0]->realisations[0]);
    }

    /** @test */
    public function it_has_many_medias()
    {
        $realisation = create(Realisation::class);

        $medias = create('App\Media', [
            'path' => 'fakepath',
            'mediable_type' => Realisation::class,
            'mediable_id' => $realisation->id
        ], 2);

        $this->assertEquals(2, $realisation->medias->count());
        $this->assertInstanceOf('App\Media', $realisation->medias[0]);
    }

    /** @test */
    public function it_belongs_to_a_category()
    {
        $category = create('App\Category', ['type' => Realisation::class]);

        $realisation = create(Realisation::class, [
            'category_id' => $category->id
        ]);

        $this->assertEquals(1, $realisation->category->count());
        $this->assertInstanceOf('App\Category', $realisation->category);
    }

    /** @test */
    public function it_belongs_to_many_skills()
    {
        $skills = create('App\Skill', [], 2);

        $realisation = create(Realisation::class);
        $realisation->skills()->sync([$skills[0]->id, $skills[1]->id]);

        $this->assertEquals(2, $realisation->skills->count());
        $this->assertInstanceOf('App\Skill', $realisation->skills[0]);
    }


}
