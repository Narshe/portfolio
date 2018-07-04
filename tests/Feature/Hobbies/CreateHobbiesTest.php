<?php

namespace Tests\Feature\Hobbies;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateHobbiesTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function admin_can_see_create_form()
    {
        $category = create('App\Category', ['type' => 'App\Hobby']);

        $response = $this->get(route('HobbiesCreate'));

        $response
            ->assertStatus(200)
        ;
    }

    /** @test */
    public function admin_can_create_new_hobby()
    {

        $hobby = make('App\Hobby');

        $response = $this->post(route('HobbiesStore'), $hobby->toArray());

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Ce hobby a bien été ajouté')
        ;

        $this->assertDatabaseHas('hobbies', ['name' => $hobby->name]);
    }

    /** @test */
    public function hobby_name_is_required()
    {
        $this->validateHobbies([
            'name' => ''
        ]);
    }

    /** @test */
    public function hobby_name_has_an_existing_category()
    {
        $this->validateHobbies([
            'category_id' => '999'
        ]);
    }

    /** @test */
    public function hobby_name_has_a_valid_url_if_not_null()
    {
        $this->validateHobbies([
            'url' => 'Invalid url'
        ]);
    }


    private function validateHobbies($params)
    {
        $hobby = make('App\Hobby', $params);

        $this->expectException("Illuminate\Validation\ValidationException");
        $this->post(route('HobbiesStore'), $hobby->toArray());
    }
}
