<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\Skill;

class CreateSkillsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_see_create_form()
    {
        $category = create('App\Category');
        $level = create('App\Level');

        $response = $this->get(route('SkillsCreate'));

        $response
            ->assertStatus(200)
            ->assertSee($category->name)
            ->assertSee($level->name)
        ;
    }

    /** @test */
    public function admin_can_store_a_new_skill_without_image()
    {

        $skill = make('App\Skill');

        $response = $this->post(route('SkillsStore'), [
            'name' => $skill->name,
            'category_id' => $skill->category->id,
            'level_id'  => $skill->level->id,
            'description' => $skill->description[0],
            'visible'   => "visible",

        ]);

        $this->assertDatabaseHas('skills', ['name' => $skill->name]);
    }

    /** @test */
    public function admin_can_store_a_new_skill_with_images()
    {
        $skill = make('App\Skill');

        $response = $this->post(route('SkillsStore'), [
            'name' => $skill->name,
            'category_id' => $skill->category->id,
            'level_id'  => $skill->level->id,
            'description' => $skill->description[0],
            'visible'   => "visible",
            'media' => $file = UploadedFile::fake()->image('avatar.jpg')

        ]);

        $this->assertDatabaseHas('skills', ['name' => $skill->name]);

        $skill = Skill::first();

        $this->assertEquals("testing/logos/skills/{$file->hashName()}", $skill->media->path);
        Storage::disk('testing')->assertExists("logos/skills/{$file->hashName()}");
        ;
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
        $skill = create('App\Skill');

        $this->validateSkill([
            'name' => $skill->name
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

        $this->post(route('SkillsStore'), $skill->toArray());
    }
}
