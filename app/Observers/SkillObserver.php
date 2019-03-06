<?php

namespace App\Observers;

use App\Skill;
use App\Media;
use Illuminate\Support\Facades\Storage;

class SkillObserver {


    protected $disk;

    public function __construct()
    {
        $this->disk = app()->environment() === 'testing' ? 'testing' : 'public';
    }

    public function creating(Skill $skill)
    {
        if (request()->all()) {

            $skill->visible = request()->has('visible') && request('visible');
        }

        if (request()->has('media')) {

            $skill->path = request('media')->store('skills', $this->disk);
        }
    }

    public function saving(Skill $skill)
    {
        if(!request()->has('media')) return;

        if ($skill->path) {
            Storage::disk($this->disk)->delete($skill->path);
        }

        $skill->path = request('media')->store('skills', $this->disk);
    }

}
