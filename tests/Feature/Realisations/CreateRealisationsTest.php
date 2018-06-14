<?php

namespace Tests\Feature\Realisations;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\Realisation;

class CreateRealisationsTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function admin_can_see_create_form()
    {
        $category = create('App\Category', ['type' => 'App\Realisation']);
        $skills = create('App\Skill', [], 2);

        $response = $this->get(route('RealisationsCreate'));

        $response
            ->assertStatus(200)
            ->assertSee($category->name)
            ->assertSee($skills[0]->name)
            ->assertSee($skills[1]->name)
        ;
    }

    /** @test */
    public function admin_can_create_realisation_without_image()
    {

        $skill = create('App\Skill');
        $realisation = make('App\Realisation', ['skills' => $skill->id]);

        $this->post(route('RealisationsStore'), $realisation->toArray());

        $this->assertDatabaseHas('realisations', ['name' => $realisation->name]);
    }

}
