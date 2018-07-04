<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\MediaObserver;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $fillable = ['path', 'type', 'alt', 'mediable_id', 'mediable_type', 'cover'];

    protected $table = "medias";

    protected $visible = ['path', 'alt', 'type'];

    public function storeFile(UploadedFile $file, $dirname)
    {
        return $file->store($dirname, $this->getDisk());
    }

    public function deleteFile()
    {
        Storage::disk($this->getDisk())->delete($this->path);
    }

    public function mediable()
    {
        return $this->morphTo();
    }

    public function updateCover()
    {

        if ($this->cover)
        return;

        if($mediaCover = $this->getCover())
        $mediaCover->toggleCover();

        $this->toggleCover();
    }

    public function getCover()
    {
        return $this->where(['cover' => true, 'mediable_id' => $this->mediable_id])->first();
    }

    public function toggleCover()
    {
        $this->update(['cover' => !$this->cover]);
    }

    private function getDisk()
    {
        return app()->environment() === 'testing' ? 'testing' : 'public';
    }

}
