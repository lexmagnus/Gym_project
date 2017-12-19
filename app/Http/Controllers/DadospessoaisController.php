<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DadospessoaisController extends Controller
{
    //
    public function dadosP(){
               
        $title = 'Dados Pessoais';
        return view('dadosPessoais')->with('title', $title);
    }

    
}
