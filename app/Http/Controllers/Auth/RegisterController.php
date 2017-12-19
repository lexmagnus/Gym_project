<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Pessoa;
use App\Cliente;
use Validator;
use Mail;
use Session;
use App\Mail\verifyEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|unique:users|max:20',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            /* 'contacto' => 'required|regex:/^[0-9]{9}$/',
            'name' => 'required|max:255',
            'nascimento' => 'required|regex:/^[0-3]?[0-9].[0-3]?[0-9].(?:[0-9]{2})?[0-9]{2}$/',
            'nif' => 'required|max:255',
            'sexo' => 'required|max:255',
            'peso' => 'required|max:255',
            'altura' => 'required|max:255', */
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        Session::flash('status', 'Registado! Verifique a sua caixa de correio para activar a conta.');
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verifyToken' => Str::random(40),
        ]);

        $user->pessoa = Pessoa::create([
            'name' => $data['name'],
            /* 'contacto' => $data['contacto'],
            'nascimento' => $data['nascimento'],
            'nif' => $data['nif'],
            'sexo' => $data['sexo'],
            'peso' => $data['peso'],
            'altura' => $data['altura'], */
            'user_id' => $user->id,
        ]);

        $user->pessoa->cliente = Cliente::create([
            'pessoa_id' => $user->pessoa->id,
        ]);

        $thisUser = User::find($user->id);
        $this->sendEmail($thisUser);
        return $user;
    }

    //Override
    // função para que o login não seja efectuado automaticamente
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);
        return redirect('/');

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    public function sendEmail($thisUser)
    {
        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
    }

    /*public function verifyEmailFirst(){
        return view('email.verifyEmailFirst');
    }*/

    public function sendEmailDone($email, $verifyToken){
        $user = User::where(['email'=>$email, 'verifyToken'=>$verifyToken])->first();
        if($user){
            User::where(['email'=>$email, 'verifyToken'=>$verifyToken])->update(['status'=>'1', 'verifyToken'=>NULL]);
            Session::flash('activated', 'Verificação efectuada com sucesso! Faça login e ENJOY THE RIDE!');
            return redirect('/');
        }else{
            Session::flash('error_token', 'Utilizador não encontrado');
            return redirect('home');
        }
    }
}
