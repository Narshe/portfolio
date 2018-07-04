<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['email', 'firstname', 'lastname', 'firstname', 'content', 'client_ip', 'is_read'];


    public function markAsRead()
    {
        $this->update(['is_read' => 1]);
    }

    public static function countUnread()
    {
        return self::where(['is_read' => 0])->count();
    }
}
