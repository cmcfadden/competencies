<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Experience;

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
        $experiences = experience::getExperiencesForUser(Auth::user()->id)->pluck("elem_name", "elem_id");
        return view('rate.reflect', compact('competencies', 'experiences'));
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
        $experiences = experience::getExperiencesForUser(Auth::user()->id)->pluck("elem_name", "elem_id");
        return view('rate.reflect', compact('competencies', 'rate', 'experiences'));
    }

}
