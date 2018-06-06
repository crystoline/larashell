<?php

namespace Crystoline\LaraShell;

use Illuminate\Support\ServiceProvider;

class LaraShellProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes/main.php';
        $this->loadViewsFrom(__DIR__.'/views', 'larashell');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // register our controller
        $this->app->make('Crystoline\LaraShell\Controller\CmdToolController');
    }
}
