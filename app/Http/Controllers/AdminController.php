<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use App\Mail\verifyEmail;
use App\User;
use Validator;
use App\Pessoa;
use App\Cliente;
use App\Instrutor;
use App\Morada;
use Mail;

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
            ->paginate(6);
            
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
                    ->paginate(6);
                
                }else{
                    $pessoa = DB::table('pessoas')
                        ->join('users', 'users.id', '=', 'pessoas.user_id')
                        ->join('clientes', 'pessoas.id', '=', 'clientes.pessoa_id')
                        ->select('users.*', 'pessoas.name', 'pessoas.contacto')
                        ->where("users.".$request->type, '=', $request->search)
                        ->paginate(6);
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
                                        Editar
                                    </div>
                                </a>

                                <a class='face-button' href='".route('deletecliente', $pess->id)."'>

                                    <div class='face-primary'>
                                        Apagar
                                    </div>
                                    <div class='face-secondary'>
                                        Apagar
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
        User::find($request->id)->delete();

        $output = "Cliente eliminado";
        
        return Response($output);
    }

    public function create_client(Request $request){

            DB::table('users')->insert([
                ['username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'verifyToken' => Str::random(40),]
            ]);

            $id=DB::getPdo()->lastInsertId();

            DB::table('pessoas')->insert([
                ['name' => $request->name,
                'user_id' => $id]
            ]);

            $id2=DB::getPdo()->lastInsertId();

            DB::table('clientes')->insert([
                ['pessoa_id' => $id2]
            ]);

            $thisUser = User::find($id);
            
            Mail::to($request->email)->send(new verifyEmail($thisUser));
        
            $output="Cliente inserido com sucesso!";
            return Response($output);
    }

    public function pt()
    {
        //return all clients
        $pessoa = DB::table('pessoas')
            ->join('users', 'users.id', '=', 'pessoas.user_id')
            ->join('instrutors', 'pessoas.id', '=', 'instrutors.pessoa_id')
            ->select('users.*', 'pessoas.name', 'pessoas.contacto')
            ->paginate(6);
            
            //dd($pessoa);
            return view('admin.pt',compact('pessoa'));
    }

    public function create_pt(Request $request){

        $output="";
        DB::table('users')->insert([
            ['username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'verifyToken' => Str::random(40),]
        ]);

        $id=DB::getPdo()->lastInsertId();

        DB::table('pessoas')->insert([
            ['name' => $request->name,
            'user_id' => $id]
        ]);

        $id2=DB::getPdo()->lastInsertId();
        //dd($id2);
        DB::table('instrutors')->insert([
            ['pessoa_id' => $id2]
        ]);

        $thisUser = User::find($id);
        
        Mail::to($request->email)->send(new verifyEmail($thisUser));

        $output.="<tr>".
                "<td style='text-align: center;'>".$thisUser->id."</td>".
                "<td style='text-align: center;'>".$request->username."</td>".
                "<td style='text-align: center;'>".$request->email."</td>".
                "<td style='text-align: center;'>".$request->name."</td>".
                "<td style='text-align: center;'> </td>".
                "<td style='text-align: center;'>".
                "<a class='face-button' href='".route('deletecliente', $thisUser->id)."'>

                        <div class='face-primary'>
                            Editar
                        </div>

                        <div class='face-secondary'>
                            Editar
                        </div>
                    </a>
                            
                    <a class='face-button' href='".route('deletecliente', $thisUser->id)."'>

                        <div class='face-primary'>
                            Apagar
                        </div>
                        <div class='face-secondary'>
                            Apagar
                        </div>
                    </a>
                </td>
                </tr>";
            return Response($output);
    }

    public function find_pt(Request $request){
            
        if($request->ajax()){
            $output="";
            
            if(($request->type) == "name"){
                $pessoa = DB::table('pessoas')
                    ->join('users', 'users.id', '=', 'pessoas.user_id')
                    ->join('instrutors', 'pessoas.id', '=', 'instrutors.pessoa_id')
                    ->select('users.*', 'pessoas.name', 'pessoas.contacto')
                    ->where("pessoas.".$request->type, '=', $request->search)
                    ->paginate(6);
                
                }else{
                    $pessoa = DB::table('pessoas')
                        ->join('users', 'users.id', '=', 'pessoas.user_id')
                        ->join('instrutors', 'pessoas.id', '=', 'instrutors.pessoa_id')
                        ->select('users.*', 'pessoas.name', 'pessoas.contacto')
                        ->where("users.".$request->type, '=', $request->search)
                        ->paginate(6);
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
                                        Editar
                                    </div>
                                </a>

                                <a class='face-button' href='".route('deletecliente', $pess->id)."'>

                                    <div class='face-primary'>
                                        Apagar
                                    </div>
                                    <div class='face-secondary'>
                                        Apagar
                                    </div>
                                </a>
                            </td>
                            </tr>";
                        }
                        return Response($output);
                    
                    }
                }
            }

    public function deletept(Request $request){
        User::find($request->id)->delete();

        $output = "Personal Trainer eliminado";
        
        return Response($output);

    }
}