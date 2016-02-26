<?php

namespace App\Providers;

use App\Model\Option;
use Illuminate\Support\ServiceProvider;
use View;

class InstanceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->composeOptionInstance();
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

    /**
     *  compose option instance.
     */
    private function composeOptionInstance()
    {
        View::composer([
            'manage.option.items',
        ], function ($view) {
            $view->with([
                'new' => new Option()
            ]);
        });
    }

}
