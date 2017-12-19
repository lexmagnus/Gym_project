<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Input;
use Session;
use Hash;
use App\Pessoa;
use App\Morada;
use Image;

class PerfilController extends Controller
{
    public function index($username){
        $user  = Auth::user($username);
        $teste = $user->id;
        
        //dd($teste);
        $pessoa = Pessoa::where(['user_id'=>$user->id])->first();
        //dd($pessoa->morada_id);
        //$posts = Morada::all();
        //dd($posts);
        if(($pessoa->morada_id) != NULL){
        $morada = Morada::where(['id'=>($pessoa->morada_id)])->first();
        return view('perfil',compact('user', 'pessoa', 'morada'));
    }else
    return view('perfil',compact('user', 'pessoa'));
        //dd($morada);
        //return [$user, $pessoa, $morada];
        
    }

    public function perfil($username){
        $user  = Auth::user($username);
        $teste = $user->id;
        
        //dd($teste);
        $pessoa = Pessoa::where(['user_id'=>$user->id])->first();
        //dd($pessoa->morada_id);
        //$posts = Morada::all();
        //dd($posts);
        if(($pessoa->morada_id) != NULL){
        $morada = Morada::where(['id'=>($pessoa->morada_id)])->first();
        return view('show_perfil',compact('user', 'pessoa', 'morada'));
    }else
    return view('show_perfil',compact('user', 'pessoa'));
    }

    public function update_avatar(Request $request){

        if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );

    		$user = Auth::user();
    		$user->avatar = $filename;
            $user->save();
            $pessoa = Pessoa::where(['user_id'=>$user->id])->first();
        }
        return view('perfil',compact('user', 'pessoa'));
    }

    public function show_edit(){
        return view('edit_perfil');
    }

    public function email(){
        return view('email');
    }

    public function pass(){
        return view('password');
    }

    public function edit_pass(Request $request){
        $user = Auth::user();
        if ($user && Hash::check($request->password, $user->password)) {

            $password = $request->new_password;
            //dd($request->new_password);
            $hashedPassword = Hash::make($password);
            $user->password = $hashedPassword;
            $user->save();
            //dd(Hash::check($request->password, $user->password));
            
            Session::flash('pass', 'Password alterada com sucesso!');
            return redirect("/home/$user->username");
        }else{
            Session::flash('pass_error', 'Erro ao alterar a password!');
    		return redirect("/home/$user->username");
    	}
    }

    public function edit_email(Request $request){
        $user = Auth::user();
        if($user){
            $user->email = $request->email;
            $user->save();
            Session::flash('email', 'Email alterado com sucesso!');
            return redirect("/home/$user->username");
        }else{
            Session::flash('email_error', 'Email alterado com sucesso!');
    		return redirect("/home");
    	}
    }

    public function edit(Request $request){
        $user = Auth::user();
        $pessoa = Pessoa::where(['user_id'=>$user->id])->first();
        //dd($pessoa);
        if($pessoa){
            $pessoa->name = $request->name;
            $pessoa->contacto = $request->contacto;
            $pessoa->nascimento = $request->nascimento;
            $pessoa->nif = $request->nif;
            $pessoa->sexo = $request->sexo;
            $pessoa->peso = $request->peso;
            $pessoa->altura = $request->altura;
            $pessoa->save();
            Session::flash('dados', 'Dados inseridos com sucesso!');
            return redirect("/home/$user->username");
        }else{
    		return redirect("/home");
    	}
    }

}
