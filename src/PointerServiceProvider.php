<?php

namespace BfAtoms\Pointer;

use Illuminate\Support\ServiceProvider;

class PointerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }
    

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->publishes([
            __DIR__.'/pointer.php' => config_path('pointer.php'),
        ]);
    }
}
