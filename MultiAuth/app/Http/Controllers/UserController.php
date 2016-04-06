<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class UserController extends Controller {
	

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = "user";
        $this->middleware('auth');
    }

	public function getHome() {
        $name = DB:
		echo "Logged In<br/>";
		echo "<a href='".action('Auth\AuthController@getLogout')."'>Logout</a>";
        dd(\Auth::user('user'));
	}

    public function setPassword() {

    }
}