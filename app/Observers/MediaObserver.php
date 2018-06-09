<?php

namespace App\Observers;

use App\Media;
use Illuminate\Support\Facades\Storage;

class MediaObserver {



  public function deleting(Media $media)
  {

    $dirname= dirname($media->path);

    if(count(Storage::files($dirname)) == 1) {
      Storage::deleteDirectory($dirname);
    }
    else {
      Storage::delete($media->path);
    }

  }



}
