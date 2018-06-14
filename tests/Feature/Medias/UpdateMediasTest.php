<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class UpdateMediasTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function admin_can_delete_media()
    {

        $file = UploadedFile::fake()->image('photo.jpg');

        $realisation = create('App\Realisation');

        $media = create('App\Media', [
            'mediable_type' => 'App\Realisation',
            'mediable_id'   => $realisation->id,
            'path'  => "testing/pictures/realisations/{$realisation->id}/{$file->hashName()}"
        ]);

        $response = $this->delete(route('MediasDestroy', $media->id));

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Cette image a bien été supprimé')
        ;

        $this->assertDatabaseMissing('medias', ['id' => $media->id, 'path' => $media->path]);

    }

}
