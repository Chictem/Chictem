<?php namespace App\Providers;

use App\Model\Option;
use Response;
use Illuminate\Support\ServiceProvider;
use View, DB;
class ArrayServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeOptionsColumns();
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
     *  compose options_columns variable.
     */
    private function composeOptionsColumns()
    {
        View::composer([
            'manage.option.items',
        ], function ($view) {
            $view->with([
                'columns' => $this->getOptionValueByKey('options_columns')
            ]);
        });
    }

    /**
     * Get option value.
     *
     * @return mixed
     */
    private function getOptionValueByKey($key)
    {
        $value = Option::item($key)->value;
        return $value;
    }

}
