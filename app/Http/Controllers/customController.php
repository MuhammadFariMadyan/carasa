<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class customController extends BaseController
{
	function index()
	{
		return view('index');
	}
}