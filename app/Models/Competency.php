<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competency extends Model
{

    use SoftDeletes;

    protected static function boot() {
        parent::boot();
        static::addGlobalScope('order', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->orderBy('official_order', 'asc');
        });
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function descriptorTraits()
    {
        return $this->hasMany('App\Models\DescriptorTrait', "competency_id");
    }

	public function levels()
    {
        return $this->hasMany('App\Models\Level', "competency_id");
    }

    public function descriptors()
    {
        return $this->hasMany('App\Models\Descriptor', "competency_id");
    }

    public function rate_responses()
    {
        return $this->belongsToMany('App\Models\RateResponse')->withTimestamps();
    }

}
