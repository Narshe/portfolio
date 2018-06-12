<?php

namespace App\Observers;

use App\Skill;
use App\Media;


class SkillObserver {

    public function created(Skill $skill)
    {
      if (request()->has('media')) {

          $media = new Media();

          $media->create([
              'mediable_type' => Skill::class,
              'mediable_id'   => $skill->id,
              'type' => 'logo',
              'alt'  => request('name'). '-' . 'logo',
              'path' => $media->uploadFile(request('media'), 'logos/skills')
          ]);
      }
    }

    public function deleting(Skill $skill) {

        if($skill->media) {
          $skill->media->delete();
        }
    }

}
