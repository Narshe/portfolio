<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Realisation;
use App\Skill;
use App\Media;
use App\SkillCategory;
use App\Category;

use App\Http\Requests\RealisationRequest;

class RealisationsController extends AdminController
{
    /**
     * [index]
     * @return View Admin/Realisations/index.blade.php
     */
    public function index()
    {
        $realisations = Realisation::all();

        return view('Admin.Realisations.index', compact('realisations'));
    }

    /**
     * [show]
     * @param  Realisation $realisation
     * @return View Admin/Realisations/show.blade.php
     */
    public function show(Realisation $realisation)
    {

        return view('Admin.Realisations.show', compact('realisation'));
    }

    /**
     * [create]
     * @return View Admin/Realisations/create.blade.php
     */
    public function create()
    {
        $realisation = new Realisation();
        $skills = Skill::with('Category')->get();
        $experiencesCategories = Category::where('type', 'App\Realisation')->get();

        $skillsGrouped = $skills->groupBy(function ($item, $key) {
            return $item->category->name;
        });

        return view('Admin.Realisations.create', compact('realisation', 'skills', 'skillsGrouped', 'experiencesCategories'));
    }

    /** Event triggered
     * [store]
     * @param  RealisationRequest $request
     * @return Redirect to realisations/index
     */
    public function store(RealisationRequest $request)
    {
        Realisation::create([
            'name' => $request->input('name'),
            'visible' => !! $request->input('visible'),
            'url' => $request->input('url'),
            'date_begin' => $request->input('date_begin'),
            'date_end' => $request->input('date_end'),
            'company' => $request->input('company'),
            'category_id' => $request->input('category_id'),
            'position' => $request->input('position'),
        ]);

        return redirect()->route('Realisations')->with('success', 'Cette réalisation a bien été ajouté');
    }

    /**
     * [edit]
     * @param  Realisation $realisation
     * @return View Admin/Realisations/edit.blade.php
     */
    public function edit(Realisation $realisation)
    {
        $experiencesCategories = Category::where('type', 'App\Realisation')->get();

        $skillsGrouped = Skill::with('Category')->get()->groupBy(function($item, $key) {
            return $item->category->name;
        });


        return view('Admin.Realisations.edit', compact('realisation', 'skillsGrouped', 'experiencesCategories'));
    }

    /**
     * [update]
     * @param  Realisation        $realisation
     * @param  RealisationRequest $request
     * @return Redirect to realisations/index
     */
    public function update(Realisation $realisation, RealisationRequest $request)
    {
        $realisation->updateRealisation();

        return redirect()->route('Realisations')->with('success', 'Cette réalisation a bien été modifié');
    }

    /** Event triggered
     * [destroy]
     * @param  Realisation $realisation
     * @return Redirect to realisations/index
     */
    public function destroy(Realisation $realisation)
    {
        $realisation->delete();

        return redirect()->route('Realisations')->with('success', 'Cette réalisation a bien été supprimé');
    }


}
