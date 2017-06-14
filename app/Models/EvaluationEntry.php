<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationEntry extends Model
{
    public function evaluation() {
    	return $this->belongsTo('App\Models\Evaluation', "evaluation_id");
    }

 	public function descriptor() {
    	return $this->belongsTo('App\Models\Descriptor');
    }  
}
