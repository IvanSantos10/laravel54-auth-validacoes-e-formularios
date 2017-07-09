<?php

namespace App\Providers;

use Code\Validator\Cpf;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('cpf', function ($attribute, $value, $parameters, $validador){
            return (new Cpf())->isValid($value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) { // consider turning this into a method like isDevEnvironment() if you need more logic
            array_map([$this->app, 'register'], config('app.devProviders'));
        }
    }
}
