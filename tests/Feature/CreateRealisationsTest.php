<?php

namespace Tests\Feature;

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

        $skills = [create('App\Skill')->id, create('App\Skill')->id];
        $realisation = make('App\Realisation', ['skills' => $skills]);

        $this->post(route('RealisationsStore'), $realisation->toArray());

        $this->assertDatabaseHas('realisations', ['name' => $realisation->name]);
    }

    /** @test */
    public function admin_can_create_realisation_with_images()
    {

        $file1 = UploadedFile::fake()->image('avatar.jpg');
        $file2 = UploadedFile::fake()->image('avatar.jpg');

        $realisation = make('App\Realisation', ['files' => [$file1, $file2]]);

         $this->post(route('RealisationsStore'), $realisation->toArray());

        $realisation = Realisation::first();

        $this->assertDatabaseHas('medias', [
            'mediable_type' => 'App\Realisation',
            'mediable_id' => $realisation->id
        ]);

        $this->assertCount(2, $realisation->medias);

        Storage::disk('testing')->assertExists("pictures/realisations/{$realisation->id}/{$file1->hashName()}");
        Storage::disk('testing')->assertExists("pictures/realisations/{$realisation->id}/{$file2->hashName()}");

        Storage::deleteDirectory('testing');
    }
}
