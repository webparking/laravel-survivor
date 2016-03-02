<?php

namespace Influendo\LaravelSurvivor;

use Blade;
use Illuminate\Support\ServiceProvider;

class SurvivorServiceProvider extends ServiceProvider
{
    /**
     * Deferef loading
     *
     * @var boolean
     */
    protected $defer = false;

    /**
     * Boot up the provider and load routes
     *
     * @return void
     */
    public function boot()
    {
        // Setup config file
        $this->publishes([__DIR__ . '/../config/config.php' => config_path('survivor.php')], 'survivor');

        // Also setup views
        $this->loadViewsFrom(__DIR__.'/../views', 'survivor');

        // Load the routes if not cached already
        if ( ! $this->app->routesAreCached()) {
            require __DIR__ . '/routes.php';
        }

        // Also load the helper file
        require __DIR__ . '/helpers.php';

        // Setup a blade directive for the ping script
        Blade::directive('survivor', function($expression) {
            app('Influendo\LaravelSurvivor\Survivor')->getScript();
        });
    }

    /**
     * Provider registration
     *
     * @return void
     */
    public function register()
    {
        // Nothing to see here, folks ...
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['survivor'];
    }

}
