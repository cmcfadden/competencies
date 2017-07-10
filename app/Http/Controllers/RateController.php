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
    public function index()
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
     * Show the form for creating a new capture resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function capture()
    {
        $competencies = \App\Models\Competency::all()->pluck('competency', 'id');
        // $rate = new \App\Models\RateResponse;
        return view('rate.reflect', compact('competencies'));
    }

    /**
     * Show the form for creating a new prepare resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function prepare(\App\Models\RateResponse $rate)
    {
        if(!$rate->id) {
            return \Redirect::action('HomeController@index');
        }

        $competencies = \App\Models\Competency::all()->pluck('competency', 'id');
        // $rate = new \App\Models\RateResponse;
        return view('rate.translate', compact('competencies', 'rate'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = new \App\Models\RateResponse;
        $response->fill($request->all());
        $response->user()->associate(Auth::user());
        $response->completed = false;
        $response->save();

        $response->competencies()->attach($request->get('competencies'));

        $items = array();
        
        foreach ($request->get('response_component') as $responseId => $content) {
            $item = new \App\Models\ResponseComponent;

            $item->fill($content);
            $item->response_type = $responseId;
            $item->response_modality = 1;
            $item->video_id = 1;
            $response->response_components()->save($item);
            $items[] = $item;
        }
        
        return \Redirect::route('rate.edit', $response->id);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Models\RateResponse $rate)
    {
        $competencies = \App\Models\Competency::all()->pluck('competency', 'id');
        return view('rate.reflect', compact('competencies', 'rate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $response = \App\Models\RateResponse::findOrFail($id);
        $response->fill($request->all());
        $response->competencies()->sync($request->get('competencies'));
        $response->save();
        foreach ($request->get('response_component') as $responseId => $content) {
            
            $item = $response->filtered_response_component($responseId);
            if(!$item) {
                $item = new \App\Models\ResponseComponent;    
            }
            
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
        return \Redirect::route('rate.edit', $response->id);
    }


    public function getDescriptorForCompetency(\App\Models\Competency $competency) {
        return $competency->descriptors;
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
