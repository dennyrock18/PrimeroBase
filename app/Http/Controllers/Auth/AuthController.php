<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    protected $maxLoginAttempts = 3;
    protected $lockoutTime = 300;

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            //'password' =>$data['password'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function loginPath()
    {
        return route('login');
    }

    public function getLogin()
    {
        return view('auth/register/login');
    }

    public function redirectPath()
    {
        return route('welcomeAdmin');
    }

    protected function getLockoutErrorMessage($seconds)
    {
        $minutos = round($seconds/60);

        return Lang::has('auth.throttle')
            ? Lang::get('auth.throttle', ['minutos' => $minutos])
            : 'Too many login attempts. Please try again in '. $seconds. ' seconds.';
    }

    public function getLogout()
    {

        //dd(auth()->user());
        auth()->user()->conectado = 0;
        auth()->user()->save();

        Auth::logout();

        return redirect('/');
    }

}
