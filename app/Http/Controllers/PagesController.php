<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        if(Auth::check()) {
            return redirect('home');
        }else{
            return view('index');
        }
        
    }
}
