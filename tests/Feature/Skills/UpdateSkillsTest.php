<?php

namespace Tests\Feature\Skills;

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

        $this->skill = create('App\Skill', [
            'path' => 'fakepath'
        ]);
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
            'description'   => $newSkill->description[0],
        ]);

        $this->assertDatabaseHas('skills', ['id' => $this->skill->id, 'name' => $newSkill->name, 'path' => $this->skill->path]);

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Votre compétence a bien été modifié')
        ;
    }


    /** @test */
    public function admin_can_update_skill()
    {

        $newSkill = make('App\Skill');


        $response = $this->patch(route('SkillsUpdate', $this->skill->id), $newSkill->toArray());

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', "Votre compétence a bien été modifié")
        ;

        $this->assertDatabaseHas('skills', ['id' => $this->skill->id, 'name' => $this->skill->fresh()->name]);
    }


    // /** @test */
    // public function a_skill_name_is_required()
    // {
    //     $this->validateSkill([
    //         'name' => "",
    //     ]);
    // }
    //
    // /** @test */
    // public function a_skill_name_has_a_maximum_of_50_characters()
    // {
    //     $this->validateSkill([
    //         'name' => str_random(51),
    //     ]);
    // }
    //
    // /** @test */
    // public function a_skill_name_must_be_unique()
    // {
    //     $newSkill = create('App\Skill');
    //
    //     $this->validateSkill([
    //         'name' => $newSkill->name
    //     ]);
    // }
    //
    // /** @test */
    // public function a_skill_must_have_a_valid_category()
    // {
    //     $this->validateSkill([
    //         'category_id' => 999
    //     ]);
    // }
    //
    // /** @test */
    // public function a_skill_must_have_a_valid_url()
    // {
    //     $this->validateSkill([
    //         'url' => 'InvalidUrl'
    //     ]);
    // }
    //
    // /** @test */
    // public function a_skill_must_have_a_valid_file()
    // {
    //     $this->validateSkill([
    //         'media' => 'InvalidFile.txt'
    //     ]);
    // }
    //
    // private function validateSkill($params)
    // {
    //     $skill = make('App\Skill', $params);
    //     $this->expectException("Illuminate\Validation\ValidationException");
    //
    //     $this->patch(route('SkillsUpdate', ['id' => $this->skill->id]), $skill->toArray());
    // }
}
