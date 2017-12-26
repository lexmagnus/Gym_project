<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;

class PagesController extends Controller
{
    //new branch teste
    public function index(){
        if(Auth::check()) {
            return redirect('home');
        }else{
            return view('index');
        }
        
    }

    public function inscricao(){
        Session::flash('status', 'Crie um registo.');
        return redirect('/#regist');
    }
}
