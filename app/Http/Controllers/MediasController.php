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

    public function edit($id)
    {

        $media = Media::findOrFail($id);


        return view('Admin.Medias.edit', compact('media'));
    }

    public function update($id, MediasRequest $request)
    {
        $media = Media::findOrFail($id);
        $params = $request->all();

        if ($media->update($params)) {
            return redirect()->route('Medias')->with('success', 'Media bien modifié');
        }

        return view('Admin.Medias.edit', compact('media'))->withErrors();
    }

    public function updateCover($id, MediasRequest $request)
    {
        $media = Media::findOrFail($id);

        if ($media->mediable_type === Realisation::class && $media->type !== 'cover') {

            if ($mediaCover = Media::where('mediable_id', $media->mediable->id)->where('type', 'cover')->first()) {

                $mediaCover->type = 'photo';
                $mediaCover->update();
            }

            $media->type = 'cover';
            $media->update();
        }

        return redirect()->route('Medias')->with('success', 'La cover a bien été modifié');
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        $media->delete();

        return redirect()->route('Medias')->with('success', 'Cette image a bien été supprimé');
    }
}
