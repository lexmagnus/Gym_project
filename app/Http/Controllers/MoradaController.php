<?php

namespace App\Http\Controllers;

use App\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Morada;

class MoradaController extends Controller
{
    public function index(){
        $user = Auth::user();
        $pessoa = Pessoa::where(['user_id'=>$user->id])->first();

        return view('morada',compact('user', 'pessoa'));
    }

    public function add(Request $request){
        $user = Auth::user();
        $pessoa = Pessoa::where(['user_id'=>$user->id])->first();
        //dd($pessoa);
        if($pessoa){
    		$morada = new Morada;
            $morada->rua = $request->rua;
            $morada->cod = $request->cod;
            $morada->localidade = $request->localidade;
            //$morada->pessoa()-save($pessoa);
            $morada->save();
            //The associate method is used to belongs relationship
            $pessoa->morada()->associate($morada)->save();
            //User::find(1)->account()->associate($account)->save();
            Session::flash('morada', 'Morada inserida com sucesso!');

    		return redirect("/home/$user->username");
    	}else{
    		return redirect("/home");
    	}
    }
}
