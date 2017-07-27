<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Experience;

class RateController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(\App\Models\RateAssignment $rateAssignment)
    {
        $competencies = \App\Models\Competency::all()->pluck('competency', 'id');
        $courseExperiences = experience::getExperiencesForUser(Auth::user()->id)->where("src_type", "crs")->pluck("elem_name", "elem_id");
        $cocurricularExperiences = experience::getExperiencesForUser(Auth::user()->id)->where("src_type", "cc")->pluck("elem_name", "elem_id");

        $typesOfCocurriculars = experience::getTypesOfCoCurriculars()->pluck("cc_type_name", "cc_type_id")->toArray();

        return view('rate.startclassic', compact('competencies', 'experiences', 'rateAssignment', 'courseExperiences', 'cocurricularExperiences', 'typesOfCocurriculars'));
    }

    public function edit(\App\Models\RateResponse $rate) {
        $experiences = experience::getExperiencesForUser(Auth::user()->id)->pluck("elem_name", "elem_id");


        $selectedExperience = experience::getExperiencesForUser(Auth::user()->id)->where("elem_id", $rate->experience)->first();

        return view('rate.classic', compact('rate','selectedExperience'));
    }

    public function view(\App\Models\RateResponse $rate, $authCode)
    {
        $competencies = \App\Models\Competency::all()->pluck('competency', 'id');
        $experiences = experience::getExperiencesForUser(Auth::user()->id)->pluck("elem_name", "elem_id");
        echo "HEY";
        // return view('rate.classic', compact('competencies', 'experiences', 'rateAssignment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->get("rate_response")) {
            // we've actually got a response to update, let's do an update instead!  
            $response = \App\Models\RateResponse::findOrFail($request->get("rate_response"));
            return $this->update($request, $response);
        }
        $response = new \App\Models\RateResponse;
        $response->fill($request->all());
        $response->user()->associate(Auth::user());
        $response->completed = false;
        $response->save();
        $response->competencies()->attach($request->get('competencies'));

        $items = array();
        $type = [];
        if($request->get('response_component')) {
            foreach ($request->get('response_component') as $responseId => $content) {
                $item = new \App\Models\ResponseComponent;
                $type[] = $responseId;
                $item->fill($content);
                $item->response_type = $responseId;
                $item->response_modality = 1;
                $item->video_id = 1;
                $response->response_components()->save($item);
                $items[] = $item;
            }
        }
        
        
        if(count($type) > 1 || count($type) == 0) {
            return \Redirect::route('rate.edit', $response->id);    
        }
        else {
            return \Redirect::route($type[0] .".edit", $response->id);
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\Models\RateResponse $rate)
    {
        $response = $rate;
        $response->fill($request->all());
        if($request->get('competencies')) {
            $response->competencies()->sync($request->get('competencies'));            
        }

        if($request->get("submit")) {
            $response->completed = true;
        }

        $response->save();
        $types = [];
        foreach ($request->get('response_component') as $responseId => $content) {
            if(isset($content["id"])) {
                $item = $response->response_components->where('id', $content["id"])->first();
            }
            elseif($item = $response->filtered_response_component($responseId)) {

            }
            else {
                $item = new \App\Models\ResponseComponent;    
            }

        
            $type[] = $responseId;
            $item->fill($content);
            $item->response_type = $responseId;
            $item->response_modality = 1;
            $item->video_id = 1;
            if($item->response_id) {
                $item->save();
            }
            else {
                $response->response_components()->save($item);
            }
            
        }

        if($response->completed && count($type > 1)) {
            // todo show evaluation response
            return redirect("/")->with('feedback', 'THIS ISN:T RIGHT');
        }
        else {
            return redirect("/")->with('feedback', 'AWESOME WORK THIS SHOULD BE RANDOM');
        }

        // if(count($type) > 1) {
        //     return \Redirect::route('rate.edit', $response->id);    
        // }
        // else {
        //     return \Redirect::route($type[0] . ".edit", [$response->id, $item->id]);
        // }
    }


    public function getDescriptorForCompetency(\App\Models\Competency $competency) {
        return $competency->descriptors;
    }


    /**
     * getExperiencesForCompetency function
     *
     *  Find experiences the student has captured for a given competency.
     *  If an experience has already been assigned a primary competency, only return it for queries against that competency
     *
     *  Only return options where there's a reflect (this should always be true)
     *  
     * @return JSON array of experiences
     * @author 
     **/
    
    public function getExperiencesForCompetency(\App\Models\Competency $competency) {
        $experiences = \App\Models\RateResponse::whereHas('user', function($query) {
            $query->where('user_id', Auth::user()->id); })
                ->where('primary_competency_id', null)
                ->whereHas('competencies', function($query) use ($competency) {
                    $query->where('competency_id', $competency->id);
                    })
                ->whereHas('response_components', function($query) use ($competency) {
                    $query->where('response_type', "reflect");
                    })
                ->get();

        $experiencesWithPrimaryCompetency = \App\Models\RateResponse::whereHas('user', function($query) {
            $query->where('user_id', Auth::user()->id); })
            ->whereHas('response_components', function($query) use ($competency) {
                    $query->where('response_type', "reflect");
                })
            ->where('primary_competency_id', $competency->id)->get();
        $mergedArrays = array_merge($experiences->toArray(), $experiencesWithPrimaryCompetency->toArray());
        // we do this to avoid a merge
        $userExperiences = experience::getExperiencesForUser(Auth::user()->id)->pluck("elem_name", "elem_id")->toArray();
        foreach($mergedArrays as $key=>$experience) {
            if(array_key_exists($experience["experience"], $userExperiences)) {
                $mergedArrays[$key]["experience_name"] = $userExperiences[$experience["experience"]];
            }
        }
        return $mergedArrays;
    }

    /**
     * getReflectionForRateResponse 
     *
     * Get the "reflect" response for a give rate_response
     *
     * @return void
     * @author 
     **/
    public function getReflectionForRateResponse(\App\Models\RateResponse $rate) 
    {
        $reflection = $rate->filtered_response_component("reflect");

        if($reflection->response_modality == 1) {
            return view("rate.reflect-static_text", compact('reflection'));
        }
        else {
            return view("rate.reflect-static_video", compact('reflection'));   
        }
    }

    public function createCocurricular(Request $request) {
        $cocurricularId = experience::createCocurricular($request->get("cocurricularType"), $request->get("cocurricularDescriptor"), Auth::user()->id);
        return response()->json(["cocurricularId"=>$cocurricularId]);

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
