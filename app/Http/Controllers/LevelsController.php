<?php

namespace App\Http\Controllers;

use App\Http\Requests\LevelsRequest;
use App\Level;

class LevelsController extends AdminController
{
    /**
     * [index]
     * @return View Admin/Levels/index.blade.php
     */
    public function index()
    {
        $levels = Level::orderBy('value', 'ASC')->get();

        return view('Admin.Levels.index', compact('levels'));
    }

    /**
     * [create]
     * @return View Admin/Levels/index.blade.php
     */
    public function create()
    {
        $level = new Level();

        return view('Admin.Levels.create', compact('level'));
    }

    /**
     * [store]
     * @param  LevelsRequest $request
     * @return Redirect to levels/index
     */
    public function store(LevelsRequest $request)
    {
        Level::create($request->all());

        return redirect()->route('Levels')->with('success', 'Ce niveau a bien été ajouté');
    }

    /**
     * [edit]
     * @param  Level   $level
     * @return View Admin/Levels/edit.blade.php
     */
    public function edit(Level $level)
    {
        return view('Admin.Levels.edit', compact('level'));
    }

    /**
     * [update]
     * @param  Level         $level
     * @param  LevelsRequest $request
     * @return Redirect to levels/index
     */
    public function update(Level $level, LevelsRequest $request)
    {
        $level->update($request->all());

        return redirect()->route('Levels')->with('success', 'Ce niveau a bien été modifié');
    }

    /**
     * [destroy]
     * @param  Level  $level
     * @return Redirect to levels/index
     */
    public function destroy(Level $level)
    {
        $level->delete();
        return redirect()->route('Levels')->with('success', 'Ce niveau a bien été supprimé');
    }
}
