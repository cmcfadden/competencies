<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReflectController extends RateController
{
    public function index(Request $request) {
    	if($request->ajax()) {
            $responses = Auth::user()->rate_responses()->whereHas('response_components', function($query) {
                    $query->where('response_type', "reflect");
                    })
            ->where("completed", 0)->get()->load('competencies');
            return response()->json($responses);
        }
        
        return view('rate.reflect-list');
    }

    public function create() {
        $competencies = \App\Models\Competency::all()->pluck('competency', 'id');
        // $rate = new \App\Models\RateResponse;
        return view('rate.reflect', compact('competencies'));
    }

	/**
     * Show the form for editing the specified reflect resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Models\RateResponse $rate)
    {
        $competencies = \App\Models\Competency::all()->pluck('competency', 'id');
        return view('rate.reflect', compact('competencies', 'rate'));
    }

}
