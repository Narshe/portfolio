<?php

namespace App\Http\Controllers;

use App\Hobby;
use App\Category;
use App\Media;
use App\Http\Requests\HobbiesRequest;

class HobbiesController extends AdminController
{
    /**
     * [index]
     * @return View Admin/Hobbies/index.blade.php
     */
    public function index()
    {
        $hobbies = Hobby::all();

        return view('Admin.Hobbies.index', compact('hobbies'));
    }

    /**
     * [create]
     * @return View Admin/Hobbies/create.blade.php
     */
    public function create()
    {
        $hobby = new Hobby();
        $hobbyCategories = Category::where('type', 'App\Hobby')->get();

        return view('Admin.Hobbies.create', compact('hobby', 'hobbyCategories'));
    }

    /**
     * [store ]
     * @param  HobbiesRequest $request
     * @return Redirect to hobbies/index
     */
    public function store(HobbiesRequest $request)
    {
        $hobby = Hobby::create($request->all());

        return redirect()->route('Hobbies')->with('success', 'Ce hobby a bien été ajouté');
    }

    /**
     * [edit]
     * @param  Hobby  $hobby
     * @return View Admin/Hobbies/edit.blade.php
     */
    public function edit(Hobby $hobby)
    {
        $hobbyCategories = Category::where('type', 'App\Hobby')->get();

        return view('Admin.Hobbies.edit', compact('hobby', 'hobbyCategories'));
    }

    /**
     * [update]
     * @param  Hobby          $hobby
     * @param  HobbiesRequest $request
     * @return Redirect to hobbies/index
     */
    public function update(Hobby $hobby, HobbiesRequest $request)
    {
        $hobby->update($request->all());

        return redirect()->route('Hobbies')->with('success', 'Ce hobby a bien été modifié');
    }

    /**
     * [destroy]
     * @param  Hobby  $hobby
     * @return Redirect to hobbies/index
     */
    public function destroy(Hobby $hobby)
    {
        $hobby->delete();
        return redirect()->route('Hobbies')->with('success', 'Ce hobby a bien été supprimé');
    }
}
