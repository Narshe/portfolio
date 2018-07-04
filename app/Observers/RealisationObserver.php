<?php

namespace App\Observers;

use App\Realisation;

use App\Media;

class RealisationObserver {


    public function created(Realisation $realisation)
    {
        $realisation->skills()->sync(request('skills'));

        if(!request()->has('files')) return ;

        $realisation->storeFiles();

    }

    public function saved(Realisation $realisation)
    {
        $realisation->skills()->sync(request('skills'));
    }


    public function deleted(Realisation $realisation) {

        foreach($realisation->medias as $media) {
            $media->delete();
        }
    }



}
