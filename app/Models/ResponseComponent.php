<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponseComponent extends Model
{

	protected $fillable = ['response_type', 'response_text'];

    public function response()
    {
        return $this->belongsTo('App\Models\RateResponse', 'response_id');
    }
}
