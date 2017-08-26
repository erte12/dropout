<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Uncomment if you want to see SQL queries on website */
        DB::listen(function ($query) {
            // echo $query->sql . '<br />';
            // $query->bindings
            // echo $query->time . '<br />';
        });

        /* Custom validation rules */
        Validator::extend('array_unique', function ($attribute, $value, $parameters, $validator) {
            return count($value) == count(array_unique($value));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
     public function register()
     {

     }
}
