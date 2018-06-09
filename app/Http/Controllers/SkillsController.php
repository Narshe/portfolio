<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SkillsRequest;
use Illuminate\Support\Facades\Storage;
use App\Skill;
use App\Category;
use App\Level;
use App\Media;

class SkillsController extends AdminController
{
    public function index()
    {
        $skills = Skill::with('Category', 'Level')->get();

        return view('Admin.Skills.index', compact('skills'));
    }

    public function show($id)
    {
        $skill = Skill::findOrFail($id);

        return view('Admin.Skills.show', compact('skill'));
    }

    public function create()
    {
        $skill = new Skill();
        $skillCategories = Category::where('type', 'Skill')->get()->pluck('name', 'id');
        $levels = Level::orderBy('value', 'ASC')->get()->pluck('name', 'id');

        return view('Admin.Skills.create', compact('skill', 'skillCategories', 'levels'));
    }

    public function store(SkillsRequest $request)
    {
        $skill = new Skill();

        $params = $request->all();
        $params['visible'] = (isset($params['visible'])) ? 1 : 0;


        if ($skill = $skill->create($params)) {

            if (isset($params['media'])) {
                $this->handleMedia($params, $skill);
            }

            return redirect()->route('Skills')->with('success', 'La compétence a bien été ajouté');
        } else {

            $levels = Level::orderBy('value', 'ASC')->get()->pluck('name', 'id');
            $skillCategories = Category::where('type', 'Skill')->get()->pluck('name', 'id');
            return view('Admin.Skills.create', compact('skillCategories', 'levels'))->withErrors();
        }
    }

    public function edit($id)
    {
        $skill = Skill::findOrFail($id);

        $skillCategories = Category::where('type', 'Skill')->get()->pluck('name', 'id');
        $levels = Level::orderBy('value', 'ASC')->get()->pluck('name', 'id');

        return view('Admin.Skills.edit', compact('skill', 'skillCategories', 'levels'));
    }

    public function update($id, SkillsRequest $request)
    {
        $skill = Skill::findOrFail($id);
        $params = $request->all();

        $params['visible'] = (isset($params['visible'])) ? 1 : 0;

        if ($skill->update($params)) {

            if (isset($params['media'])) {
                $this->handleMedia($params, $skill);
            }

            return redirect()->route('Skills')->with('success', "Votre compétence a bien été modifié");
        } else {

            $skillCategories = Category::all()->pluck('name', 'id');
            $levels = Level::orderBy('value', 'ASC')->get()->pluck('name', 'id');
            return view('Admin.Skills.edit', compact('skillCategories', 'skill', 'levels'))->withErrors();
        }
    }

    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);

        $skill->delete();

        return redirect()->route('Skills')->with('success', "Cette compétence a bien été supprimé");
    }

    private function handleMedia($params, Skill $skill)
    {
        $media = new Media();
        $media->uploadFile($params['media'], 'logos/skills');
        $media->mediable_id = $skill->id;
        $media->mediable_type = Skill::class;
        $media->type = "logo";
        $media->alt = $params['name'].'-'.$media->type;
        $media->save();
    }
}
