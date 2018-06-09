<?php

namespace App\Observers;

use App\Hobby;

use App\Http\Requests\SkillsRequest;

class HobbyObserver {

  public function deleting(Hobby $hobby) {

    if($hobby->media) {
      $hobby->media->delete();
    }
  }



}
