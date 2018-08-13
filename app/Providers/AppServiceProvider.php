<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema ; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191) ; 

        \View::composer('threads.channels',function($view){

            $view->with('channels',\App\Channel::all()) ; 
        });

         \View::composer('posts.categories',function($view){

            $view->with('categories',\App\Category::all()) ; 
        });


         //Create A New Validator 
        \Validator::extend('spamfree','App\Rules\SpamFree@passes');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
