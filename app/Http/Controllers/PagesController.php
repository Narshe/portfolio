<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Realisation;
use App\Level;
use App\School;
use App\Category;
use App\Skill;

class PagesController extends Controller
{

    public function home()
    {

        $levels = Level::where('value', '>', 0)->orderBy('value', 'ASC')->get();
        $realisations = Realisation::with('Medias')->where('visible', 1)->get();
        $schools = School::orderBy('date_begin', 'DESC')->get();

        $skillsWithCategories = Category::with('skills', 'skills.level', 'skills.media')
            ->where('type', 'Skill')
            ->get()
        ;
        $realisationsWithCategories = Category::with('realisations','realisations.medias', 'realisations.skills')
            ->where('type', 'Experience')
            ->get()
        ;
        $hobbiesWithCategories = Category::with('hobbies','hobbies.media')
            ->where('type', 'Hobby')
            ->get()
        ;

        return view('home', compact('realisationsWithCategories','skillsWithCategories', 'levels', 'schools', 'hobbiesWithCategories'));
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
