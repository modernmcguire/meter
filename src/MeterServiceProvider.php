<?php

namespace ModernMcGuire\Meter;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class MeterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'meter');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'meter');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('meter.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/meter'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/meter'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/meter'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }

        // Load up the metric classes
        if(config('meter.enabled')) {
            foreach(config('meter.metrics') as $metric) {
                $metric = App::make($metric);
                $metric = new $metric();
                $metric->register();
            }
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'meter');
    }
}
