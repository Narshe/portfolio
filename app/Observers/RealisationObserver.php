<?php

namespace App\Observers;

use App\Realisation;

class RealisationObserver {


  public function deleted(Realisation $realisation) {

      foreach($realisation->medias as $media) {
        $media->delete();
      }


  }


}
