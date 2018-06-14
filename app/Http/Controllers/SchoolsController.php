<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\School;
use App\Http\Requests\SchoolsRequest;

class SchoolsController extends AdminController
{
    /**
     * [index]
     * @return View Admin/Schools/index.blade.php
     */
    public function index()
    {

        $schools = School::all();
        return view('Admin.Schools.index', compact('schools'));
    }

    /**
     * [create]
     * @return View Admin/Schools/create.blade.php
     */
    public function create()
    {
        $school = new School();

        return view('Admin.Schools.create', compact('school'));
    }

    /**
     * [store]
     * @param  SchoolsRequest $request
     * @return Redirect to schools/index
     */
    public function store(SchoolsRequest $request)
    {
        $school = new School();
        $school->create($request->all());

        return redirect()->route('Schools')->with('success', "Cette formation a bien été ajouté");
    }

    /**
     * [edit]
     * @param  School $school
     * @return View Admin/schools/edit.blade.php
     */
    public function edit(School $school)
    {
        return view('Admin.Schools.edit', compact('school'));
    }

    /**
     * [update]
     * @param  School         $school
     * @param  SchoolsRequest $request
     * @return Redirect to schools/index
     */
    public function update(School $school, SchoolsRequest $request)
    {
        $school->update($request->all());
        return redirect()->route('Schools')->with('success', 'Cette formation a bien été modifié');
    }


    /**
     * [destroy]
     * @param  School $school
     * @return Redirect to schools/index
     */
    public function destroy(School $school)
    {
        $school->delete();
        return redirect()->route('Schools')->with('success', 'Cette formation a bien été supprimé');
    }
}
