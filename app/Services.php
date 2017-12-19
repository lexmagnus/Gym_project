<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    // public function cliente()
    // {
    //     return $this->hasMany('App\Cliente');
    // }

    // muitos serviços têm muitos clientes
    public function clientes()
    {
        return $this->hasMany('App\Clientes');
    }
}
