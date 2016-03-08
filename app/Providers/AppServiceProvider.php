<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        Blade::extend(function ($value) {
            return preg_replace('/@define(.+)/', '<?php ${1}; ?>', $value);
        });
        Blade::extend(function ($value) {
            $value = preg_replace('/(?<=\s)@switch\((.*)\)(\s*)@case\((.*)\)(?=\s)/', '<?php switch($1):$2case $3: ?>', $value);
            $value = preg_replace('/(?<=\s)@endswitch(?=\s)/', '<?php endswitch; ?>', $value);
            $value = preg_replace('/(?<=\s)@case\((.*)\)(?=\s)/', '<?php case $1: ?>', $value);
            $value = preg_replace('/(?<=\s)@default(?=\s)/', '<?php default: ?>', $value);
            $value = preg_replace('/(?<=\s)@endcase(?=\s)/', '<?php break; ?>', $value);
            return $value;
        });
        Blade::extend(function ($value) {
            $value = preg_replace('/(?<=\s)@me\((.*)\)(?=\s)/', '<?php if(is_me(${1})) { ?>', $value);
            $value = preg_replace('/(?<=\s)@endme(?=\s)/', '<?php } ?>', $value);
            return $value;
        });
        Blade::extend(function ($value) {
            $value = preg_replace('/(?<=\s)@auth(?=\s)/', '<?php if(Auth::user()) { ?>', $value);
            $value = preg_replace('/(?<=\s)@endauth(?=\s)/', '<?php } ?>', $value);
            return $value;
        });
        Blade::extend(function ($value) {
            $value = preg_replace('/(?<=\s)@guest(?=\s)/', '<?php if(!Auth::user()) { ?>', $value);
            $value = preg_replace('/(?<=\s)@endguest(?=\s)/', '<?php } ?>', $value);
            return $value;
        });
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
