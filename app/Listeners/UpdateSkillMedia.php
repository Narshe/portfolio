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
        $event->model->media->deleteFile();
        $event->model->media->update([
            'path' => $event->model->media->uploadFile(request('media'), 'logos/skills')
        ]);

    }
}
