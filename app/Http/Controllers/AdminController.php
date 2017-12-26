<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use App\Pessoa;
use App\Morada;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientes()
    {

        //$users  = Auth::user()->get();
        //$users = DB::table('users')->get();

        $pessoa = DB::table('pessoas')
            ->join('users', 'users.id', '=', 'pessoas.user_id')
            ->join('clientes', 'pessoas.id', '=', 'clientes.pessoa_id')
            ->select('users.*', 'pessoas.*')
            ->get();
        dd($pessoa);
        //$pessoa = Pessoa::all();
        
        //dd($teste);
        //$pessoa = Pessoa::with()->find(1);
        //$pessoa->user()->attach($user->id);
        //dd($pessoa->morada_id);
        //$posts = Morada::all();
        //dd($posts);
        //if(($pessoa->morada_id) != NULL){
           // $morada = Morada::where(['id'=>($pessoa->morada_id)])->first();
            return view('admin.clientes',['users' => $users]);
      //  }else{
        //    return view('admin.clientes',compact('user', 'pessoa'));
       // }
    }
}