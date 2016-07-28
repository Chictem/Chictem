<?php

namespace App\Providers;

use App\Models\Permission;
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
            $groups = Permission::distinct()->lists('group');
            foreach ($groups as $group) {
                $permission_groups[$group] = Permission::where('group', $group)->get();
            }
            $view->with([
                'permission_groups' => $permission_groups
            ]);
        });
    }
}
