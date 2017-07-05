<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index(Request $request)
    {
    	$flashContent = "HEY";
        return view('home.index', compact("flashContent"));
        
    }
}
