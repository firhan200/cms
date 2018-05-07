<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';

    public function message_receiver()
    {
        return $this->hasMany('App\Models\Message_Receiver');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }
}
