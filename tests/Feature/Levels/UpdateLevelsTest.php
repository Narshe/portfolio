<?php

namespace Tests\Feature\Levels;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateLevelsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_see_edit_form()
    {
        $level = create('App\Level');
        $response = $this->get(route('LevelsEdit', $level->id));

        $response
            ->assertStatus(200)
        ;
    }

    /** @test */
    public function admin_can_update_a_level()
    {

        $level = create('App\Level');
        $newLevel = make('App\Level');

        $response = $this->patch(route('LevelsUpdate', $level->id),[
            'name' => $newLevel->name,
            'value'=> $level->value
        ]);

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Ce niveau a bien été modifié')
        ;

        $this->assertDatabaseHas('levels', ['id' => $level->id, 'name' => $newLevel->name]);
    }

    /** @test */
    public function admin_can_delete_a_level()
    {
        $level = create('App\Level');

        $this->assertDatabaseHas('levels', ['id' => $level->id, 'name' => $level->name]);

        $response = $this->delete(route('LevelsDestroy', $level->id));

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Ce niveau a bien été supprimé')
        ;

        $this->assertDatabaseMissing('levels', ['id' => $level->id, 'name' => $level->name]);
    }
}
