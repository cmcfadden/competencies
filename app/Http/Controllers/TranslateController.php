<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class TranslateController extends RateController
{

    public function index(Request $request) {

        if($request->ajax()) {
        
            $responses = Auth::user()->rate_responses()->where("classic_rate",false)->whereHas('response_components', function($query) {
                    $query->where('response_type', "translate");
                    })
            ->get()->load("response_components")->load("primary_competency");


            $outputArray = array();
            foreach($responses as $response) {
                foreach($response->response_components as $responseComponent) {
                    if($responseComponent->response_type == "translate") {
                        $response->translateComponentId = $responseComponent->id;
                        $outputArray[] = $response;
                    }

                }


            }

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
