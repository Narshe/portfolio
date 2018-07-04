<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

use App\Media;

class MediaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_morph_to_different_model_associated()
    {
        $skill = create('App\Skill');
        $realisation = create('App\Realisation');

        $mediaSkill = create(Media::class, [
            'mediable_type' => 'App\Skill',
            'mediable_id'   => $skill->id,
            'path' => 'Fakepath'
        ]);

        $mediaRealisation = create(Media::class, [
            'mediable_type' => 'App\Realisation',
            'mediable_id'   => $realisation->id,
            'path' => 'Fakepath'
        ]);

        $this->assertInstanceOf('App\Skill', $mediaSkill->mediable);
        $this->assertInstanceOf('App\Realisation', $mediaRealisation->mediable);
    }

    /** @test */
    public function it_can_toggle_cover_attribute()
    {
        $realisation = create('App\Realisation');
        $media = create(Media::class, [
            'mediable_type' => 'App\Realisation',
            'mediable_id'   => $realisation->id,
            'path' => 'Fakepath',
            'cover' => 0
        ]);

        $this->assertEquals(0, $media->cover);

        $media->toggleCover();

        $this->assertEquals(1, $media->cover);
    }

    /** @test */
    public function it_can_update_a_cover_of_a_realisation()
    {
        $realisation = create('App\Realisation');

        $mediaCover = create(Media::class, [
            'mediable_type' => 'App\Realisation',
            'mediable_id'   => $realisation->id,
            'path' => 'Fakepath1',
            'cover' => true
        ]);

        $media = create(Media::class, [
            'mediable_type' => 'App\Realisation',
            'mediable_id'   => $realisation->id,
            'path' => 'Fakepath2',
            'cover' => false
        ]);

        $this->assertEquals(1, $mediaCover->cover);
        $this->assertEquals(0, $media->cover);

        $media->updateCover();

        $this->assertEquals(0, $mediaCover->fresh()->cover);
        $this->assertEquals(1, $media->fresh()->cover);

    }

    /** @test */
    public function it_can_store_and_delete_a_file()
    {
        $file =  UploadedFile::fake()->image('avatar.jpg');

        $media = new Media;

        $media->path = "skills/{$file->hashName()}";

        $media->storeFile($file, 'skills');

        Storage::disk('testing')->assertExists($media->path);

        $media->deleteFile();

        Storage::disk('testing')->assertMissing($media->path);

        Storage::deleteDirectory('testing');
    }




}
