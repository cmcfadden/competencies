<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Descriptor extends Model
{

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
