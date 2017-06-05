<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function competency()
    {
        return $this->belongsTo('App\Models\Competency', 'competency_id');
    }
}
