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

        Blade::if('disabled', function ($column_name) {
            return strpos($column_name, 'disabled') !== false;
        });

        // custom if else for form input types

        Blade::directive('isInteger', function ($arg) {
            return "<?php if (strpos($arg, 'integer') !== false || strpos($arg, 'bigint')) { ?>";
        });
        Blade::directive('elseifInteger', function ($arg) {
            return "<?php } else if (strpos($arg, 'integer') !== false || strpos($arg, 'bigint')) { ?>";
        });

        Blade::directive('isString', function ($arg) {
            return "<?php if (strpos($arg, 'string') !== false) { ?>";
        });
        Blade::directive('elseifString', function ($arg) {
            return "<?php } else if (strpos($arg, 'string') !== false) { ?>";
        });

        Blade::directive('isDate', function ($arg) {
            return "<?php if (strpos($arg, 'date') !== false) { ?>";
        });
        Blade::directive('elseifDate', function ($arg) {
            return "<?php } else if (strpos($arg, 'date') !== false) { ?>";
        });

        Blade::directive('isDecimal', function ($arg) {
            return "<?php if (strpos($arg, 'decimal') !== false) { ?>";
        });
        Blade::directive('elseifDecimal', function ($arg) {
            return "<?php } else if (strpos($arg, 'decimal') !== false) { ?>";
        });

        Blade::directive('isFloat', function ($arg) {
            return "<?php if (strpos($arg, 'float') !== false) { ?>";
        });
        Blade::directive('elseifFloat', function ($arg) {
            return "<?php } else if (strpos($arg, 'float') !== false) { ?>";
        });

        Blade::directive('isChoices', function ($arg) {
            return "<?php if (strpos($arg, 'choices') !== false) { ?>";
        });
        Blade::directive('elseifChoices', function ($arg) {
            return "<?php } else if (strpos($arg, 'choices') !== false) { ?>";
        });

        Blade::directive('elseif', function () {
            return "<?php } else { ?>";
        });
        Blade::directive('end', function () {
            return "<?php } ?>";
        });
    }
}
