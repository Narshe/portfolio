<?php

namespace Tests\Feature\Realisations;

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
    public function admin_can_update_realisation()
    {
        $skill = create('App\Skill');

        $realisation = make('App\Realisation', [
            'skills' => [$skill->id]
        ]);

        $this->patch(route('RealisationsUpdate', $this->realisation->id), $realisation->toArray());

        $this->assertDatabaseHas('realisations', [
            'id' => $this->realisation->id,
            'name' => $realisation->name
        ]);

    }

    /** @test */
    public function admin_can_update_realisation_cover()
    {

        $realisation = create('App\Realisation');
        $media = create('App\Media', [
            'mediable_id'   => $realisation->id,
            'mediable_type' => 'App\Realisation',
            'cover'  => 1,
            'path'  => 'fakepath'
        ]);

        $mediaWithoutcover =create('App\Media', [
            'mediable_id'   => $realisation->id,
            'mediable_type' => 'App\Realisation',
            'path'  => 'fakepath'
        ]);

        $this->patch(route('CoversUpdate', $mediaWithoutcover->id));

        $this->assertTrue(!! $mediaWithoutcover->fresh()->cover);
        $this->assertFalse(!! $media->fresh()->cover);

    }

}
