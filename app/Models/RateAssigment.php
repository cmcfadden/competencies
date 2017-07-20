<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RateAssignment extends Model
{

	public $fillable = ["assignment_title","active", "target_email"];
    public function user() {
        return $this->belongsTo("App\User", "user_id");
    }

}
