<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    public function services()
    {
        return $this->hasMany('App\Services');
    }
}
