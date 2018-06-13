<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UpdateRealisationsTest extends TestCase
{
    use RefreshDatabase;

    protected $realisation;

    public function setUp()
    {
        parent::setUp();

        $this->realisation = create('App\Realisation');
    }

    /** @test */
    public function admin_can_see_edit_form_with_informations_of_the_current_realisation()
    {
        $response =$this->get(route('RealisationsEdit', $this->realisation->id));

        $response
            ->assertStatus(200)
            ->assertSee($this->realisation->name)
            ->assertSee($this->realisation->category->name)
        ;
    }

    /** @test */
    public function admin_can_update_realisation_and_add_new_images()
    {
        $file = UploadedFile::fake()->image('photo.jpg');
        $skills = create('App\Skill', [], 2);

        $realisation = make('App\Realisation', [
            'skills' => [$skills[0]->id, $skills[1]->id],
            'files' => [$file]
        ])->toArray();

        $this->patch(route('RealisationsUpdate', $this->realisation->id), $realisation);

        $this->assertDatabaseMissing('realisations', [
            'id' => $this->realisation->id,
            'name' => $this->realisation->name
        ]);

        $this->assertDatabaseHas('realisations', [
            'id' => $this->realisation->id,
            'name' => $realisation['name']
        ]);

        $this->delete(route('RealisationsDestroy', $this->realisation->id));

        $this->assertDatabaseMissing('realisations', ['name' => $this->realisation->id]);

        $directories = Storage::directories("testing/pictures/realisations");

        $this->assertEmpty($directories);

        Storage::deleteDirectory('testing');
    }


}
