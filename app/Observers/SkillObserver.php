<?php

namespace App\Observers;

use App\Skill;
use App\Media;


class SkillObserver {

    public function created(Skill $skill)
    {
      if (request()->has('media')) {
          
        $skill->uploadFile();
      }
    }

    public function deleting(Skill $skill) {

        if($skill->media) {
          $skill->media->delete();
        }
    }

}
