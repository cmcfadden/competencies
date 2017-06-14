<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Descriptor extends Model
{
    public function competency()
    {
        return $this->belongsTo('App\Models\Competency', 'competency_id');
    }

	public function level()
    {
        return $this->belongsTo('App\Models\Level', 'level_id');
    }

    public function descriptor_trait() {
    	return $this->belongsTo('App\Models\DescriptorTrait', 'trait_id');
    }
}
