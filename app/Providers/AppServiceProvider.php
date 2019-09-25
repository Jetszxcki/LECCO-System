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

        Blade::if('hasAccessRights', function($rights) {
            foreach ($rights as $right) {
                if (! User::hasAccessRight($right)) {
                    return false;
                }
            }

            return true;
        });

        Blade::if('disabled', function ($column_data) {
            return in_array('disabled', $column_data['args']);
        });

        Blade::if('radio', function ($column_data) {
            return in_array('radio', $column_data['args']);
        });

        Blade::if('checkbox', function ($column_data) {
            return in_array('checkbox', $column_data['args']);
        });
    }
}
