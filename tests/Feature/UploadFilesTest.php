<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

use App\Realisation;
use App\Skill;

class UploadFilesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_delete_realisation_folder_when_a_realisation_is_deleted()
    {
        $file =  UploadedFile::fake()->image('avatar.jpg');

        $realisation = createWithEvents('App\Realisation');

        $path = $file->store("testing/pictures/realisations/{$realisation->id}");

        $media = createWithEvents('App\Media', [
            'path'  => $path,
            'mediable_id' => $realisation->id,
            'mediable_type' => 'App\Realisation'
        ]);

        $this->delete(route('RealisationsDestroy', $realisation->id));

        $directories = Storage::directories("testing/pictures/realisations");

        $this->assertEmpty($directories);
    }

    /** @test */
    public function admin_can_upload_files_for_realisations()
    {
        $file1 = UploadedFile::fake()->image('avatar.jpg');
        $file2 = UploadedFile::fake()->image('avatar.jpg');

        $realisation = make('App\Realisation', ['files' => [$file1, $file2]]);

        $this->post(route('RealisationsStore'), $realisation->toArray());

        $realisation = Realisation::first();

        $this->assertCount(2, $realisation->medias);

        Storage::disk('testing')->assertExists("pictures/realisations/{$realisation->id}/{$file1->hashName()}");
        Storage::disk('testing')->assertExists("pictures/realisations/{$realisation->id}/{$file2->hashName()}");

    }

    /** @test */
    public function admin_can_add_files_for_realisations_during_update()
    {
        $file = UploadedFile::fake()->image('photo.jpg');
        $realisation = create('App\Realisation');

        $newRealisation = make('App\Realisation', ['files' => [$file] ]);

        $this->patch(route('RealisationsUpdate', $realisation->id),$newRealisation->toArray());

        Storage::disk('testing')->assertExists("pictures/realisations/{$realisation->id}/{$file->hashName()}");

    }


    /** @test */
    public function admin_can_upload_file_for_skills()
    {
        $file = UploadedFile::fake()->image('avatar.jpg');
        $skill = make('App\Skill', ['media' => $file]);

        $response = $this->post(route('SkillsStore'), $skill->toArray());

        Storage::disk('testing')->assertExists("skills/{$file->hashName()}");

    }

    /** @test */
    public function admin_can_update_uploaded_file_for_skills()
    {
        $file =  UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store("skills", "testing");

        $skill = createWithEvents('App\Skill', [
            'path' => $path
        ]);

        $newSkill = make('App\Skill', [
            'media' => $newFile = UploadedFile::fake()->image('newAvatar.jpg'),
            'path' => $path
        ]);

        $this->patch(route('SkillsUpdate', $skill->id), $newSkill->toArray());

        Storage::disk('testing')->assertMissing("skills/{$file->hashName()}");
        Storage::disk('testing')->assertExists("skills/{$newFile->hashName()}");

    }

    /** @test */
    public function it_delete_skill_picture_when_a_skill_is_deleted()
    {
        $file =  UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store("testing/logos/skills");

        $skill = create('App\Skill');
        $media = create('App\Media', [
            'path'  => $path,
            'mediable_id' => $skill->id,
            'mediable_type' => 'App\Skill'
        ]);

        $this->delete(route('SkillsDestroy', $skill->id));

        Storage::disk('testing')->assertMissing("skills/{$file->hashName()}");

        Storage::deleteDirectory('testing');
    }
}
