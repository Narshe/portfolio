<?php

namespace App\Http\Controllers;

use App\Http\Requests\LevelsRequest;
use App\Level;

class LevelsController extends AdminController
{
    public function index()
    {
        $levels = Level::orderBy('value', 'ASC')->get();

        return view('Admin.Levels.index', compact('levels'));
    }

    public function create()
    {
        $level = new Level();

        return view('Admin.Levels.create', compact('level'));
    }

    public function store(LevelsRequest $request)
    {
        $params = $request->all();
        $level = new Level();
        if ($level->create($params)) {
            return redirect()->route('Levels')->with('success', 'Ce niveau a bien été ajouté');
        } else {
            return view('Admin.Levels.create', compact('level'))->withErrors();
        }
    }

    public function edit($id)
    {
        $level = Level::findOrFail($id);
        return view('Admin.Levels.edit', compact('level'));
    }

    public function update($id, LevelsRequest $request)
    {
        $level = Level::findOrFail($id);

        if ($level->update($request->all())) {
            return redirect()->route('Levels')->with('success', 'Ce niveau a bien été modifié');
        } else {
            return view('Admin.Levels.edit', compact('level'))->withErrors();
        }
    }

    public function destroy($id)
    {
        $level = Level::findOrFail($id);
        $level->delete();
        return redirect()->route('Levels')->with('success', 'Ce niveau a bien été supprimé');
    }
}
