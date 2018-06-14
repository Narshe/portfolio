<?php

namespace App\Http\Controllers;

use App\Media;

class UpdateCoversController extends Controller
{
    public function update(Media $media)
    {
        $media->updateCover();
        return redirect()->route('Medias')->with('success', 'La cover a bien été modifié');
    }
}
