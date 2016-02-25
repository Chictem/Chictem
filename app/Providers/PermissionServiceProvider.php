<?php

namespace App\Providers;

use App\Model\Permission;
use Illuminate\Support\ServiceProvider;
use View;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeAllPermissions();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     *  compose permissions variable.
     */
    private function composeAllPermissions()
    {
        View::composer([
            'manage.role.show',
        ], function ($view) {
            $view->with([
                'permissions' => Permission::all()
            ]);
        });
    }
}
