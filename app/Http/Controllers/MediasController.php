<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Media;
use App\Realisation;
use App\Http\Requests\MediasRequest;

class MediasController extends AdminController
{
    public function index()
    {

        $medias = Media::with('mediable')->get();

        $mediasWithType = $medias->groupBy(function($item, $key){

            $item->mediable_type = explode('\\', $item->mediable_type);

            return $key = $item->mediable_type[1];
        });


        return view('Admin.Medias.index', compact('medias', 'mediasWithType'));
    }

    public function edit(Media $media)
    {
        return view('Admin.Medias.edit', compact('media'));
    }

    public function update(Media $media, MediasRequest $request)
    {

        $media->update($request->all());
        return redirect()->route('Medias')->with('success', 'Media bien modifié');
    }


    public function destroy(Media $media)
    {

        $media->delete();
        return redirect()->route('Medias')->with('success', 'Cette image a bien été supprimé');
    }
}
