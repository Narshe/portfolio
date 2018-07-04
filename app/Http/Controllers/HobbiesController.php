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

        return view('Admin.Hobbies.create', compact('hobby'));
    }

    /**
     * [store ]
     * @param  HobbiesRequest $request
     * @return Redirect to hobbies/index
     */
    public function store(HobbiesRequest $request)
    {
        $hobby = Hobby::create([
            'name' => $request->input('name'),
            'visible' => !! $request->input('visible'),
            'url' => $request->input('url'),
            'description' => $request->input('description'),
            'icon' => $request->input('icon')
        ]);

        return redirect()->route('Hobbies')->with('success', 'Ce hobby a bien été ajouté');
    }

    /**
     * [edit]
     * @param  Hobby  $hobby
     * @return View Admin/Hobbies/edit.blade.php
     */
    public function edit(Hobby $hobby)
    {
        return view('Admin.Hobbies.edit', compact('hobby'));
    }

    /**
     * [update]
     * @param  Hobby          $hobby
     * @param  HobbiesRequest $request
     * @return Redirect to hobbies/index
     */
    public function update(Hobby $hobby, HobbiesRequest $request)
    {

        $hobby->update([
            'name' => $request->input('name'),
            'visible' => !! $request->input('visible'),
            'url' => $request->input('url'),
            'description' => $request->input('description'),
            'icon' => $request->input('icon')
        ]);

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
