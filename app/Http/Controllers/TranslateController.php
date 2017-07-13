<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TranslateController extends RateController
{


    /**
     * Show the form for creating a new translate resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
