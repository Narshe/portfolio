<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RenderHomeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function home_page_should_not_render_invisible_data()
    {
        $this->renderWithCategories(\App\Skill::class, 0);
        $this->renderWithCategories(\App\Realisation::class, 0);
        $this->renderWithCategories(\App\Hobby::class, 0);
    }

    /** @test */
    public function home_page_should_render_visible_skills_with_their_categories()
    {
        $this->renderWithCategories(\App\Skill::class);
    }

    /** @test */
    public function home_page_should_render_realisations_with_their_categories()
    {
        $this->renderWithCategories(\App\Realisation::class);
    }

    /** @test */
    public function home_page_should_render_hobbies_with_their_categories()
    {
        $this->renderWithCategories(\App\Hobby::class);
    }

    /** @test */
    public function home_page_should_render_schools()
    {

        $school = create(\App\School::class);

        $response = $this->get("/");

        $response->assertSee($school->name);
    }

    /** @test */
    public function home_page_should_render_levels()
    {

        $level = create(\App\Level::class);

        $response = $this->get("/");

        $response->assertSee($level->name);
    }

    private function renderWithCategories($model, $visible = 1)
    {
        $model = create($model, ['visible' => $visible]);

        $response = $this->get("/");

        if ($visible) {

            $response
                ->assertSee($model->name)
                ->assertSee($model->category->name)
            ;
        } else {

            $response
                ->assertDontSee($model->name)
                ->assertDontSee($model->category->name)
            ;
        }
    }

}