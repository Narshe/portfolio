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

    public function storeFile(UploadedFile $file, $dirname)
    {
        if (app()->environment() === 'testing') return $file->store("testing/{$dirname}");
<<<<<<< HEAD
        
=======

>>>>>>> Hobbies
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


    public function updateCover()
    {

        if (!$this->mediable instanceof Realisation || $this->isCoverType())
        return;

        $media =  $this->where(['type' => 'cover', 'mediable_id' => $this->mediable_id])->first();

        if($media)
        $this->uncover($media);

        $this->cover();
    }


    public function isCoverType()
    {
        return $this->type === 'cover';
    }

    public function cover()
    {
        $this->update(['type' => 'cover']);
    }

    public function uncover($media)
    {
        $media->update(['type' => 'photo']);
    }


}
