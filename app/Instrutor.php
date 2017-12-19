<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrutor extends Model
{
    public function pessoa()
    {
        return $this->belongsTo('App\Pessoa');
    }

    // Um instrutor tem muitos serviços
    public function services()
    {
        return $this->hasMany('App\Service');
    }
}
