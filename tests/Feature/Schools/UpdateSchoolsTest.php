<?php

namespace Tests\Feature\Schools;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateSchoolsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_see_edit_form()
    {
        $school = create('App\School');

        $response = $this->get(route('SchoolsEdit', $school->id));

        $response
            ->assertStatus(200)
        ;
    }

    /** @test */
    public function admin_can_create_new_school()
    {

        $school = create('App\School');
        $newSchool = make('App\School');

        $response = $this->patch(route('SchoolsUpdate', $school->id), $newSchool->toArray());

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Cette formation a bien été modifié')
        ;

        $this->assertDatabaseHas('schools', ['id' => $school->id, 'name' => $newSchool->name]);
    }

    /** @test */
    public function admin_can_delete_a_school()
    {
        $school = create('App\School');

        $this->assertDatabaseHas('schools', ['id' => $school->id, 'name' => $school->name]);

        $response = $this->delete(route('SchoolsDestroy', $school->id));

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Cette formation a bien été supprimé')
        ;

        $this->assertDatabaseMissing('schools', ['id' => $school->id, 'name' => $school->name]);
    }
}
