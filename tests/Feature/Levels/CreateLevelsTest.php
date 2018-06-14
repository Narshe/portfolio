<?php

namespace Tests\Feature\Levels;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateLevelsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_see_create_form()
    {

        $response = $this->get(route('LevelsCreate'));

        $response
            ->assertStatus(200)
        ;
    }

    /** @test */
    public function admin_can_create_new_level()
    {

        $level = make('App\Level');

        $response = $this->post(route('LevelsStore'), $level->toArray());

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Ce niveau a bien été ajouté')
        ;

        $this->assertDatabaseHas('levels', ['name' => $level->name]);
    }

    /** @test */
    public function level_name_is_required()
    {
        $this->validateLevels([
            'name' => ''
        ]);
    }

    /** @test */
    public function hobby_name_is_unique()
    {
        $level = create('App\Level');

        $this->validateLevels([
            'name' => $level->name
        ]);
    }

    /** @test */
    public function hobby_value_is_unique()
    {
        $this->validateLevels([
            'value' => create('App\Level')->value
        ]);
    }

    /** @test */
    public function hobby_value_is_beetween_0_and_5()
    {
        $this->validateLevels([
            'value' => rand(10,100)
        ]);
    }


    private function validateLevels($params)
    {
        $level = make('App\Level', $params);

        $this->expectException("Illuminate\Validation\ValidationException");
        $this->post(route('LevelsStore'), $level->toArray());
    }
}
