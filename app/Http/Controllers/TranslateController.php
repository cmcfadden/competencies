<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class TranslateController extends RateController
{

    public function index(Request $request) {
        if($request->ajax()) {
            $responses = \App\Models\ResponseComponent::where("response_type", "translate")->whereHas("response", function($query) {
                $query->where("user_id", Auth::user()->id);
            })->get()->load("response")->load("response.primaryCompetency");


            dd($responses->toArray());
            $responses = Auth::user()->rate_responses()->whereHas('response_components', function($query) {
                    $query->where('response_type', "translate");
                    })
            ->where("completed", 0)->get()->load('competencies')->load("response_components");
            return response()->json($responses);
        }
        
        return view('rate.translate-list');
    }

    /**
     * Show the form for creating a new translate resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(\App\Models\RateAssignment $rateAssignment)
    {
        $competencies = \App\Models\Competency::all()->pluck('competency', 'id');
        return view('rate.translate', compact('competencies'));
    }


    /**
     * Show the form for editing the specified translate resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Models\RateResponse $rate, $componentId = null)
    {

        $rate->response_components = $rate->response_components->where('id', $componentId);
        $competencies = \App\Models\Competency::all()->pluck('competency', 'id');
        return view('rate.translate', compact('competencies', 'rate'));
    }

}
