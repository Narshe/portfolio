<?php

namespace Tests\Feature\Schools;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateSchoolsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_see_create_form()
    {

        $response = $this->get(route('SchoolsCreate'));

        $response
            ->assertStatus(200)
        ;
    }

    /** @test */
    public function admin_can_create_new_school()
    {

        $school = make('App\School');

        $response = $this->post(route('SchoolsStore'), $school->toArray());

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Cette formation a bien été ajouté')
        ;

        $this->assertDatabaseHas('schools', ['name' => $school->name]);
    }


    /** @test */
    public function school_name_is_required()
    {
        $this->validateSchools([
            'name' => ''
        ]);
    }

    /** @test */
    public function school_name_is_unique()
    {
        $school = create('App\School');

        $this->validateSchools([
            'name' => $school->name
        ]);
    }

    /** @test */
    public function school_city_has_a_maximum_of_50_characters()
    {

        $this->validateSchools([
            'city' => str_random(51)
        ]);
    }

    /** @test */
    public function school_has_a_valid_url_if_not_null()
    {

        $this->validateSchools([
            'url' => "Invalid url"
        ]);
    }

    private function validateSchools($params)
    {
        $school = make('App\School', $params);

        $this->expectException("Illuminate\Validation\ValidationException");
        $this->post(route('SchoolsStore'), $school->toArray());
    }
}
