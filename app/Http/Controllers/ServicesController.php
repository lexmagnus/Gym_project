<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function services(){
               
        $title = 'Serviços';
        return view('services')->with('title', $title);
    }
}
