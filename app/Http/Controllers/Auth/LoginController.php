<?php

namespace App\Http\Controllers\Auth;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

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
        $this->middleware('guest', ['except' => 'logout']);
    }
    
    //Override
    public function username()
    {
            return 'username';
    }
    
    //override
    protected function credentials(Request $request)
    {
        Session::flash('login', 'Login efectuado com sucesso!');
        return array_merge($request->only($this->username(), 'password'), ['status' => 1]);
    }

    public function authenticate()
    {
        if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1])) {
            // Authentication passed...
            return redirect()->intended('home');
        }
    }
}
