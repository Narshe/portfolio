<?php

namespace App\Listeners;

use App\Events\UpdateMedia;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateSkillMedia
{

    /**
     * Handle the event.
     *
     * @param  UpdateMedia  $event
     * @return void
     */
    public function handle(UpdateMedia $event)
    {
        if (!$event->model->media) return $event->model->uploadFile();

        $event->model->media->deleteFile();
        $event->model->media->update([
            'path' => $event->model->media->storeFile(request('media'), 'logos/skills')
        ]);

    }
}
