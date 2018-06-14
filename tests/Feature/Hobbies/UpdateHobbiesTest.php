<?php

namespace Tests\Feature\Hobbies;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateHobbiesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_see_edit_form()
    {
        $hobby = create('App\Hobby');

        $response = $this->get(route('HobbiesEdit', $hobby->id));

        $response
            ->assertStatus(200)
            ->assertSee($hobby->category->name)
            ->assertSee($hobby->name)
        ;
    }

    /** @test */
    public function admin_can_update_hobby()
    {
        $hobby = create('App\Hobby');
        $newHobby = make('App\Hobby');

        $response = $this->patch(route('HobbiesUpdate', $hobby->id), $newHobby->toArray());

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Ce hobby a bien été modifié')
        ;

        $this->assertDatabaseHas('hobbies', ['id' => $hobby->id, 'name' => $newHobby->name]);
    }

    /** @test */
    public function admin_can_delete_hobby()
    {
        $hobby = create('App\Hobby');

        $this->assertDatabaseHas('hobbies', ['id' => $hobby->id, 'name' => $hobby->name]);

        $response = $this->delete(route('HobbiesDestroy', $hobby->id));

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Ce hobby a bien été supprimé');

        $this->assertDatabaseMissing('hobbies', ['id' => $hobby->id, 'name' => $hobby->name]);
    }
}
