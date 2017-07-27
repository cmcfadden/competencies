<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Experience;

class ReflectController extends RateController
{
    public function index(Request $request) {
        if($request->ajax()) {
            $responses = Auth::user()->rate_responses()->where("classic_rate",false)->whereHas('response_components', function($query) {
                    $query->where('response_type', "reflect");
                    })
            ->where("completed", 0)->get()->load('competencies');
            return response()->json($responses);
        }
        
        return view('rate.reflect-list');
    }

    public function create(\App\Models\RateAssignment $rateAssignment) {
        $competencies = \App\Models\Competency::all()->pluck('competency', 'id');
        $courseExperiences = experience::getExperiencesForUser(Auth::user()->id)->where("src_type", "crs")->pluck("elem_name", "elem_id");
        $cocurricularExperiences = experience::getExperiencesForUser(Auth::user()->id)->where("src_type", "cc")->pluck("elem_name", "elem_id");

        $typesOfCocurriculars = experience::getTypesOfCoCurriculars()->pluck("cc_type_name", "cc_type_id")->toArray();

        return view('rate.reflect', compact('competencies', 'courseExperiences', 'cocurricularExperiences', 'typesOfCocurriculars'));
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
        $courseExperiences = experience::getExperiencesForUser(Auth::user()->id)->where("src_type", "crs")->pluck("elem_name", "elem_id");
        $cocurricularExperiences = experience::getExperiencesForUser(Auth::user()->id)->where("src_type", "cc")->pluck("elem_name", "elem_id");
        $typesOfCocurriculars = experience::getTypesOfCoCurriculars()->pluck("cc_type_name", "cc_type_id")->toArray();


        $selectedExperience = experience::getExperiencesForUser(Auth::user()->id)->where("elem_id", $rate->experience)->first();

        return view('rate.reflect', compact('rate', 'competencies', 'courseExperiences', 'cocurricularExperiences', 'typesOfCocurriculars', 'selectedExperience'));
    }

}