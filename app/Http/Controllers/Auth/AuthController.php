<?php

namespace App\Http\Controllers\Auth;

use App\Models\Person;
use Auth;
use Validator;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
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


   protected $redirectPath= '/dashboard';


    public function __construct(Guard $auth, Person $person)
    {   
        $this->person = $person; 
        $this->auth = $auth;
        //$this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    /**protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }*/

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

   //public function getDashboard()
    //{
        //if(Auth::user()->role=='user')
        //{
        //    return view('master.adminpage');
        //}
    //}
    /**protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    */
    public function getLogin()
    {
        if(Auth::check())
        {
            return redirect('/dashboard');
        }
        return view('content.login');
    }
    
    public function postLogin(LoginRequest $request) {
       if($this->validate($request, [
                'username' => 'required', 'password' => 'required',
            ]));
    
            $credentials = $request->only('username', 'password');
    
            if ($this->auth->attempt($credentials, $request->has('remember')))
            {
                    return redirect()->intended($this->redirectPath());
                
            }
            return redirect('/login')->withErrors([
            'username' => 'The username or the password is invalid. Please try again.',
             ]);
     }
    public function getLogout()
    {
        $this->auth->logout();
        return redirect('/login');
    }
}
