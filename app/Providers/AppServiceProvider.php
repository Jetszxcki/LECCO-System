<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

use App\User;

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
            return User::hasAccessRight($right);
        });

        Blade::if('accessrights', function ($rights) {
            foreach ($rights as $right) {
                if (User::hasAccessRight($right)) {
                    return true;
                }
            }
            return false;
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
