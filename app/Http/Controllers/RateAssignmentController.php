<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class RateAssignmentController extends Controller
{
	
	public function index(Request $request) {
        if($request->ajax()) {
            $responses = Auth::user()->rate_assignments()->get();
            return response()->json($responses);
        }
        
        return view('rateassignments.list');
    }

    public function create()
    {
        return view('rateassignments.create');
    }

	public function edit($rateAssignment)
    {
        return view('rateassignments.create', compact('rateAssignment'));
    }


	public function store(Request $request)
    {
    	$this->validate($request, [
        	'target_email' => 'required|email'
    	]);
    	$response = new \App\Models\RateAssignment;
    	$response->fill($request->all());
        $response->user()->associate(Auth::user());
        $response->save();
        return \Redirect::route('rateassignment.index');
    }

    public function update(Request $request, \App\Models\RateAssignment $rateAssignment) {
    	$rateAssignment->fill($request->all());
    	$rateAssignment->save();
    	return \Redirect::route('rateassignment.index');
    }
}
