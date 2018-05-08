<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message_Receiver extends Model
{
    protected $table = 'message_receiver';

    public function message(){
        return $this->belongsTo('App\Models\Message');
    }
}
