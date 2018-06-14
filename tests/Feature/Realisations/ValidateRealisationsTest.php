<?php

namespace Tests\Feature\Realisations;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

use App\Realisation;

class ValidateRealisationsTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function a_realisation_name_is_required()
    {
        $this->validateRealisation([
            'name' => ''
        ]);
    }
    /** @test */
    public function a_realisation_name_is_unique()
    {
        $realisation = create('App\Realisation');

        $this->validateRealisation([
            'name' => $realisation->name
        ]);
    }

    /** @test */
    public function a_realisation_company_is_required()
    {
        $this->validateRealisation([
            'company' => ''
        ]);
    }


    /** @test */
    public function a_realisation_dateBegin_must_be_lower_than_dateEnd_are_required()
    {
        $this->validateRealisation([
            'date_begin' => '2017-1-1',
            'date_end' => '2016-1-1'
        ]);
    }

    /** @test */
    public function a_realisation_position_is_required()
    {
        $this->validateRealisation([
            'position' => ''
        ]);
    }

    /** @test */
    public function a_realisation_url_must_be_valid_if_not_null()
    {
        $this->validateRealisation([
            'url' => 'Wrong url'
        ]);
    }

    /** @test */
    public function a_realisation_must_have_an_existing_category()
    {
        $this->validateRealisation([
            'category_id' => 999
        ]);
    }

    /** @test */
    public function a_realisation_must_have_an_existing_skill()
    {
        create('App\Skill');

        $this->validateRealisation([
            'skills' => ['999']
        ]);

    }

    /** @test */
    public function a_realisation_must_have_a_valid_file()
    {
        $file = UploadedFile::fake()->image("virus.txt");

        $this->validateRealisation([
            'files' => [$file]
        ]);

    }

    private function validateRealisation($params)
    {

        $newRealisation = make('App\Realisation', $params);

        $this->expectException("Illuminate\Validation\ValidationException");
        $this->post(route('RealisationsStore'), $newRealisation->toArray());

    }
}
