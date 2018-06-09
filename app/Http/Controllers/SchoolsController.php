<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\School;
use App\Http\Requests\SchoolsRequest;

class SchoolsController extends AdminController
{
    public function index()
    {

        $schools = School::all();
        return view('Admin.Schools.index', compact('schools'));
    }

    public function create()
    {
        $school = new School();

        return view('Admin.Schools.create', compact('school'));
    }

    public function store(SchoolsRequest $request)
    {

        $school = new School();
        $params = $request->all();

        if ($school->create($params)) {

            return redirect()->route('Schools')->with('success', "La formation a bien été ajouté");
        }

        return view('Admin.Schools.create', compact('school'))->withErrors();
    }

    public function edit($id)
    {
        $school = School::findOrFail($id);

        return view('Admin.Schools.edit', compact('school'));
    }

    public function update($id, SchoolsRequest $request)
    {
        $school = School::findOrFail($id);
        $params = $request->all();

        if ($school->update($params)) {
            return redirect()->route('Schools')->with('success', 'Cette formation a bien été modifié');
        }

        return view('Admin.Levels.edit', compact('level'))->withErrors();


    }

    public function destroy($id)
    {
        $level = School::findOrFail($id);
        $level->delete();
        return redirect()->route('Schools')->with('success', 'Cette formation a bien été supprimé');
    }
}
