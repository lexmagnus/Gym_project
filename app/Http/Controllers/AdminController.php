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
    
    public function find_client(Request $request){
            
        if($request->ajax()){
            
        $output="";
            
        if(($request->type) == "name"){
            $pessoa = DB::table('pessoas')
                ->join('users', 'users.id', '=', 'pessoas.user_id')
                ->join('clientes', 'pessoas.id', '=', 'clientes.pessoa_id')
                ->select('users.*', 'pessoas.name', 'pessoas.contacto')
                ->where("pessoas.".$request->type, '=', $request->search)
                ->get();

        }else{
            $pessoa = DB::table('pessoas')
                ->join('users', 'users.id', '=', 'pessoas.user_id')
                ->join('clientes', 'pessoas.id', '=', 'clientes.pessoa_id')
                ->select('users.*', 'pessoas.name', 'pessoas.contacto')
                ->where("users.".$request->type, '=', $request->search)
                ->get();
        }
            
        if($pessoa){
                
            foreach ($pessoa as $key => $pess) {
                    
                $output.="<tr>".
                        "<td style='text-align: center;'>".$pess->id."</td>".
                        "<td style='text-align: center;'>".$pess->username."</td>".
                        "<td style='text-align: center;'>".$pess->email."</td>".
                        "<td style='text-align: center;'>".$pess->name."</td>".
                        "<td style='text-align: center;'>".$pess->contacto."</td>".
                        "<td style='text-align: center;'>".
                            "<a class='face-button' href='".route('deletecliente', $pess->id)."'>

                                <div class='face-primary'>
                                    Editar
                                </div>

                                <div class='face-secondary'>
                                    ".$pess->username."
                                </div>
                            </a>

                            <a class='face-button' href='".route('deletecliente', $pess->id)."'>

                                <div class='face-primary'>
                                    Apagar
                                </div>
                                <div class='face-secondary'>
                                    ".$pess->username."
                                </div>
                            </a>
                        </td>
                        </tr>";
                    }

                    return Response($output);
                }
            }
        }

    public function deleteCliente(Request $request) {
        User::find ( $request->id )->delete ();
        return redirect('/admin');
    }
}