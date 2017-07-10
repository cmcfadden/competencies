<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponseComponent extends Model
{

	protected $fillable = ['response_type', 'response_text', 'descriptor_id'];

    public function response()
    {
        return $this->belongsTo('App\Models\RateResponse', 'response_id');
    }


    public function descriptor_trait()
    {
        return $this->hasOne('App\Models\Descriptor', 'descriptor_id');
    }
}
