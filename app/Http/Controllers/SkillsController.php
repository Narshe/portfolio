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
    /**
     * [index]
     * @return View Admin/Skills/index.blade.php
     */
    public function index()
    {
        $skills = Skill::with('Category', 'Level')->get();

        return view('Admin.Skills.index', compact('skills'));
    }

    /**
     * [create]
     * @return View Admin/Skills/create.blade.php
     */
    public function create()
    {
        $skill = new Skill();
        $skillCategories = Category::where('type', 'App\Skill')->get()->pluck('name', 'id');
        $levels = Level::orderBy('value', 'ASC')->get()->pluck('name', 'id');

        return view('Admin.Skills.create', compact('skill', 'skillCategories', 'levels'));
    }

    /**
     * [store ]
     * @param  SkillsRequest $request
     * @return Redirect to skills/index
     */
    public function store(SkillsRequest $request)
    {
        $skill = new Skill();

        Skill::create($request->except('visible'));

        return redirect()->route('Skills')->with('success', 'La compétence a bien été ajouté');
    }

    /**
     * [edit ]
     * @param  Skill  $skill
     * @return View Admin/Skills/edit.blade.php
     */
    public function edit(Skill $skill)
    {
        $skillCategories = Category::where('type', 'App\Skill')->get()->pluck('name', 'id');
        $levels = Level::orderBy('value', 'ASC')->get()->pluck('name', 'id');

        return view('Admin.Skills.edit', compact('skill', 'skillCategories', 'levels'));
    }

    /**
     * [update]
     * @param  Skill         $skill
     * @param  SkillsRequest $request
     * @return Redirect to skills/index
     */
    public function update(Skill $skill, SkillsRequest $request)
    {
        $skill->setAttribute('visible', ($request->has('visible') && $request->visible));

        $skill->update($request->except('visible'));

        return redirect()->route('Skills')->with('success', "Votre compétence a bien été modifié");
    }

    /**
     * [destroy]
     * @param  Skill  $skill
     * @return Redirect to skills/index
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('Skills')->with('success', "Cette compétence a bien été supprimé");
    }

}
