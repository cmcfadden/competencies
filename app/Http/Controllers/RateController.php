<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
    public function create()
    {
        dd("not yet");
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
        
        if(count($type) > 1) {
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

        if(count($type) > 1) {
            return \Redirect::route('rate.edit', $response->id);    
        }
        else {
            return \Redirect::route($type[0] . ".edit", [$response->id, $item->id]);
        }
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
                ->where('primaryCompetency', null)
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
            ->where('primaryCompetency', $competency->id)->get();

        return array_merge($experiences->toArray(), $experiencesWithPrimaryCompetency->toArray());
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
