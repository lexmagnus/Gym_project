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
     * 
     * 
     */
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function clientes()
    {
        //return all clients
        $pessoa = DB::table('pessoas')
            ->join('users', 'users.id', '=', 'pessoas.user_id')
            ->join('clientes', 'pessoas.id', '=', 'clientes.pessoa_id')
            ->select('users.*', 'pessoas.name', 'pessoas.contacto')
            ->paginate(4);
            
            //dd($pessoa);
            return view('admin.clientes',compact('pessoa'));
    }

    public function deleteCliente(Request $request) {
        User::find ( $request->id )->delete ();
        return redirect('/admin');
    }
}