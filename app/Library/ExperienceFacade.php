<?php

namespace App\Library;
use Illuminate\Support\Facades\Facade;

class ExperienceFacade extends Facade
{
    /**
     * Get the registered name of the component so it can be used as a facade.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
    return 'experience';
    }
}