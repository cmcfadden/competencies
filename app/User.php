<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use StudentAffairsUwm\Shibboleth\Entitlement;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
             'name', 'email','first_name','last_name', 'umndid'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function entitlements()
    {
        return $this->belongsToMany(Entitlement::class);
    }

    public function rate_responses() {
        return $this->hasMany('App\Models\RateResponse');
    }

    public function evaluations() {
        return $this->hasMany('App\Models\Evaluation');
    }

    public function rate_assignments() {
        return $this->hasMany('App\Models\RateAssignment');
    }
}
