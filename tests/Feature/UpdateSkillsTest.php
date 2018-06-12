<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UpdateSkillsTest extends TestCase
{
    use RefreshDatabase;

    protected $skill;

    public function setUp()
    {
        parent::setUp();

        $this->skill = create('App\Skill');
    }
    /** @test */
    public function admin_can_see_edit_form()
    {

        $response = $this->get(route('SkillsEdit', ['id' => $this->skill->id]));

        $response
            ->assertStatus(200)
            ->assertSee($this->skill->name)
        ;
    }

    /** @test */
    public function admin_can_update_a_skill_without_image()
    {
        $newSkill = make('App\Skill');

        $response = $this->patch(route('SkillsUpdate', ['id' => $this->skill->id]),[
            'name' => $newSkill->name,
            'url'  => $newSkill->url,
            'category_id' => $newSkill->category_id,
            'level_id'  => $newSkill->level_id,
            'description'   => $newSkill->description[0]
        ]);

        $this->assertDatabaseMissing('skills', ['id' => $this->skill->id, 'name' => $this->skill->name]);
        $this->assertDatabaseHas('skills', ['id' => $this->skill->id, 'name' => $newSkill->name]);

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Votre compétence a bien été modifié')
        ;
    }

    //Merged delete and update for test file system
    /** @test */
    public function admin_can_update_and_delete_skill()
    {
        //TODO Refactor to test file system alone
        $file =  UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store("testing/logos/skills");
        $skill = $this->skill;

        $media = create('App\Media', [
            'path'  => $path,
            'mediable_id' => $this->skill->id,
            'mediable_type' => 'App\Skill',
            'alt'   => 'test'
        ]);

        Storage::disk('testing')->assertExists("logos/skills/{$file->hashName()}");

        $this->patch(route('SkillsUpdate', ['id' => $this->skill->id]),[
            'name'  => $this->skill->name,
            'media' => $newFile = UploadedFile::fake()->image('newAvatar.jpg')
        ]);

       $this->assertEquals("testing/logos/skills/{$newFile->hashName()}",$media->fresh()->path);

        Storage::disk('testing')->assertMissing("logos/skills/{$file->hashName()}");
        Storage::disk('testing')->assertExists("logos/skills/{$newFile->hashName()}");

        $this->delete(route('SkillsDestroy', ['id' => $skill->id]));

        $this->assertDatabaseMissing('medias', ['mediable_id' => $skill->id, 'mediable_type' => 'App\Skill']);

        Storage::disk('testing')->assertMissing("logos/skills/{$newFile->hashName()}");

        Storage::deleteDirectory('testing');
    }


    /** @test */
    public function a_skill_name_is_required()
    {
        $this->validateSkill([
            'name' => "",
        ]);
    }

    /** @test */
    public function a_skill_name_has_a_maximum_of_50_characters()
    {
        $this->validateSkill([
            'name' => str_random(51),
        ]);
    }

    /** @test */
    public function a_skill_name_must_be_unique()
    {
        $newSkill = create('App\Skill');

        $this->validateSkill([
            'name' => $newSkill->name
        ]);
    }

    /** @test */
    public function a_skill_must_have_a_valid_category()
    {
        $this->validateSkill([
            'category_id' => 999
        ]);
    }

    /** @test */
    public function a_skill_must_have_a_valid_url()
    {
        $this->validateSkill([
            'url' => 'InvalidUrl'
        ]);
    }

    /** @test */
    public function a_skill_must_have_a_valid_file()
    {
        $this->validateSkill([
            'media' => 'InvalidFile.txt'
        ]);
    }

    private function validateSkill($params)
    {
        $skill = make('App\Skill', $params);
        $this->expectException("Illuminate\Validation\ValidationException");

        $this->patch(route('SkillsUpdate', ['id' => $this->skill->id]), $skill->toArray());
    }
}
