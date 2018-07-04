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

        $levels = Level::oldest('value')->get();
        $schools = School::latest('date_begin')->get();
        $hobbies = Hobby::visible()->get();

        $skillsWithCategories = Skill::getVisibleSkills();
        $realisationsWithCategories = Realisation::getVisibleRealisations();


        return view('home', compact(
            'skillsWithCategories',
            'realisationsWithCategories',
            'hobbies',
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

}
