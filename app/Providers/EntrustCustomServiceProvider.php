<?php
namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Zizaco\Entrust\EntrustServiceProvider;

class EntrustCustomServiceProvider extends EntrustServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->bladeDirectives();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Register the blade directives
     *
     * @return void
     */
    private function bladeDirectives()
    {
        Blade::directive('role', function ($expression) {
            return "<?php if (\\Entrust::hasRole{$expression}) : ?>";
        });
        Blade::directive('endrole', function ($expression) {
            return "<?php endif; // Entrust::hasRole ?>";
        });
        Blade::directive('permission', function ($expression) {
            return "<?php if (\\Entrust::can{$expression}) : ?>";
        });
        Blade::directive('endpermission', function ($expression) {
            return "<?php endif; // Entrust::can ?>";
        });
        Blade::directive('ability', function ($expression) {
            return "<?php if (\\Entrust::ability{$expression}) : ?>";
        });
        Blade::directive('endability', function ($expression) {
            return "<?php endif; // Entrust::ability ?>";
        });
    }
}