<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    protected $fillable = ['pessoa_id'];

    public function pessoa()
    {
        return $this->belongsTo('App\Pessoa');
    }
}
