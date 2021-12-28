<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //add validate text and space
        Validator::extend('alpha_spaces', function ($attribute, $value) {

            return preg_match('/^[\pL\s]+$/u', $value); 
        });
    }
}
