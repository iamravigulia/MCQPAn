<?php

namespace edgewizz\mcqpan;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class McqpanServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Edgewizz\Mcqpan\Controllers\McqpanController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // dd($this);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__ . '/components', 'mcqpan');
        Blade::component('mcqpan::mcqpan.open', 'mcqpan.open');
        Blade::component('mcqpan::mcqpan.index', 'mcqpan.index');
        Blade::component('mcqpan::mcqpan.edit', 'mcqpan.edit');
    }
}
