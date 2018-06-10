<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Realisation;
use App\Level;
use App\School;
use App\Hobby;
use App\Skill;

class PagesController extends Controller
{

    public function home()
    {

        $levels = Level::get();
        $schools = School::get();

        $skillsWithCategories = Skill::getVisibleSkills();
        $realisationsWithCategories = Realisation::getVisibleRealisations();
        $hobbiesWithCategories = Hobby::getVisibleHobbies();

        return view('home', compact(
            'skillsWithCategories',
            'realisationsWithCategories',
            'hobbiesWithCategories',
            'levels',
            'schools'
        ));
    }

    public function admin()
    {

        return view('Admin.home_admin');
    }


    public function underConstruction()
    {
        return view('underConstruction');
    }

    public function test(Request $request)
    {

        dump($request->all());
    }
}
