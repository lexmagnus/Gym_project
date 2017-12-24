<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function user(){
        return $this->belongsTo('App\user');
    }
    public function likes(){
        return $this->belongsTo('App\like');
    }
}

