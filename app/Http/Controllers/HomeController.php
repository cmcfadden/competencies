<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Experience;

class HomeController extends Controller
{

	public function index(Request $request)
    {
    	$flashContent = "HEY";
    	dd(experience::getDescriptorForExperience(1));
        return view('home.index', compact("flashContent"));
        
    }
}
