<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class EvaluateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $evaluations = \App\Models\Evaluation::all();
            $evaluations->load('competency');    
            return response()->json($evaluations);
        }
        
        return view('evaluate.list');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $competencies = \App\Models\Competency::all()->pluck('competency', 'id');
        return view('evaluate.create', compact('competencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = new \App\Models\Evaluation;
        $response->fill($request->all());
        $response->user()->associate(Auth::user());
        $response->level = 1;
        $response->save();

        foreach($request->get('evaluation_entries') as $key => $value) {
            $evaluationEntry = new \App\Models\EvaluationEntry;
            $evaluationEntry->descriptor_id = $key;
            $evaluationEntry->response = $value;
            $response->evaluation_entries()->save($evaluationEntry);

        }
        return \Redirect::route('evaluate.edit', $response->id);
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
    public function edit(\App\Models\Evaluation $evaluate)
    {
        $competencies = \App\Models\Competency::all()->pluck('competency', 'id');
        return view('evaluate.create', ['evaluation'=>$evaluate, "competencies"=>$competencies]);
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
        $response = \App\Models\Evaluation::findOrFail($id);
        $response->fill($request->all());
        $response->level = 1;
        $response->save();

        foreach($request->get('evaluation_entries') as $key => $value) {
            $evaluationEntry = \App\Models\EvaluationEntry::findOrFail($key);
            $evaluationEntry->descriptor_id = $key;
            $evaluationEntry->response = $value;
            $response->evaluation_entries()->save($evaluationEntry);

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


    public function getEvaluatorsForCompetency(\App\Models\Competency $competency) {
        return view('evaluate.entries', compact('competency'));
    }

}
