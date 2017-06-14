<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{

	protected $fillable = ['level', 'userId', 'competency_id'];
    

    public function evaluation_entries() {
    	return $this->hasMany('App\Models\EvaluationEntry', "evaluation_id");
    }

    public function evaluation_entry_for_descriptor($descriptor) {
    	return $this->evaluation_entries->filter(function ($value, $key) use ($descriptor) {
    		return $value->descriptor == $descriptor;
    	})->first();	
    }

    public function competency() {
    	return $this->belongsTo('App\Models\Competency');
    }
}
