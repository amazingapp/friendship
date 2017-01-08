<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View, Auth, JavaScript;
class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
         // Using Closure based composers...
        View::composer('layouts.master', function ($view) {
                $data = [];
                if( Auth::check() ) {
                    $data = ['User' => Auth::user()->toArray()];
                }
                JavaScript::put($data);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
