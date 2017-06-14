<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RateResponse extends Model
{
	protected $guarded = ['id'];
	protected $fillable = ['primaryCompetency', 'umnDID'];


    public function response_components()
    {
        return $this->hasMany('App\Models\ResponseComponent', "response_id");
    }

    /**
     * @param  type of response to filter for
     * @return a single eloquent object
     */
    public function filtered_response_component($componentTitle = null) {
    	$filtered = $this->filtered_response_components($componentTitle);

        if(!$filtered->isEmpty()) return $filtered->first();

        return new \App\Models\ResponseComponent;

    }

    public function filtered_response_components($componentTitle = null) {
        if(!$componentTitle) {
            return $this->response_components();
        }

        $filtered = $this->response_components->filter(function ($responseComponent) use ($componentTitle) {
            return $responseComponent->response_type == $componentTitle;
        });

        return $filtered; 
    }

    public function primaryCompetency()
    {
        return $this->belongsTo('App\Models\Competency');
    }

    public function competencies()
    {
        return $this->belongsToMany('App\Models\Competency')->withTimestamps();
    }
}
