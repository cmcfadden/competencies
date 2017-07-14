<?php

namespace App\Providers;
use App\Library\Experience;

use Illuminate\Support\ServiceProvider;


class ExperienceServiceProvider extends ServiceProvider
{
    /**
     * Indicates the service is only loaded when called to save resources.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    // public function boot()
    // {
    //     //
    // }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
         \App::bind('experience', function()
        {
            return new \App\Library\Experience;
        });
    }

    /**
     * Provides an array of strings that map to the services in the register() function.
     * This function is only called when the provider is deferred so this is the only way
     * Laravel knows which services are actually available without calling them.
     *
     * @return array
     */
    public function provides()
    {
        return ['experience'];
    }
}
