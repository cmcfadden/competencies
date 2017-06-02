<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competency extends Model
{
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

}
