<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\MediaObserver;
use Illuminate\Http\UploadedFile;

class Media extends Model
{
    protected $fillable = ['path', 'type', 'alt', 'mediable_id', 'mediable_type'];

    protected $table = "medias";
//    protected $events = ['deleting' => MediaObserver::class];

    public function uploadFile(UploadedFile $file, $dirname)
    {
        $path = $file->store('public/'.$dirname);
        $this->path = $path;

        return $this;

    }

    public function mediable()
    {
        return $this->morphTo();
    }

    /*
    public function skills()
    {
        return $this->hasMany('App\Skill');
    }

    public function realisation()
    {
        return $this->belongsToMany('App\Realisation');
    }
    */

}
