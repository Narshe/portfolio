<?php

namespace App\Observers;

use App\Skill;
use App\Media;


class SkillObserver {

  public function deleting(Skill $skill) {

    if($skill->media) {
      $skill->media->delete();
    }
  }

}
