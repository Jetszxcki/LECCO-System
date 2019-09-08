<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

use Auth;

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
        Blade::if('accessright', function ($right) {
            return Auth::user()->access_right->$right;
        });

        // Blade::if('actions', function ($right_model) {
        //     if ($right_model == 'user') {
        //         return (
        //             Auth::user()->access_right->user_delete || 
        //             Auth::user()->access_right->invoke_rights 
        //         );
        //     }
        // });
    }
}
