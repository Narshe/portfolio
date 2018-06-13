<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\MediaObserver;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $fillable = ['path', 'type', 'alt', 'mediable_id', 'mediable_type'];

    protected $table = "medias";
//    protected $events = ['deleting' => MediaObserver::class];

    // public static function boot()
    // {
    //     parent::boot();
    //
    //     static::updating(function($media) {
    //
    //         dd($media);
    //         $media->deleteFile($media);
    //     });
    // }

    public function uploadFile(UploadedFile $file, $dirname)
    {
        if (app()->environment() === 'testing') return $file->store("testing/{$dirname}");
        
        return $file->store("public/{$dirname}");
    }

    public function deleteFile()
    {
        Storage::delete($this->path);
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
