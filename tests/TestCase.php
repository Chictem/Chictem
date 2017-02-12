<?php

namespace App\Tests;

use Exception;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use App\Models\User;
use App\VoyagerServiceProvider;

class TestCase extends OrchestraTestCase
{
    protected $withDummy = true;

    public function setUp()
    {
        parent::setUp();

        $this->loadMigrationsFrom([
            '--realpath' => realpath(__DIR__.'/migrations'),
        ]);

        if (!is_dir(base_path('routes'))) {
            mkdir(base_path('routes'));
        }

        if (!file_exists(base_path('routes/web.php'))) {
            file_put_contents(base_path('routes/web.php'),
                "<?php Route::get('/', function () {return view('welcome');});");
        }

        $this->app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware('Illuminate\Session\Middleware\StartSession');
        $this->app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware('Illuminate\View\Middleware\ShareErrorsFromSession');
    }

    protected function getPackageProviders($app)
    {
        return [
            VoyagerServiceProvider::class,
        ];
    }

    public function tearDown()
    {
        //parent::tearDown();

        //$this->artisan('migrate:reset');
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        // Setup Voyager configuration
        $app['config']->set('voyager.user.namespace', User::class);

        // Setup Authentication configuration
        $app['config']->set('auth.providers.users.model', User::class);
    }

    protected function install()
    {
        $this->artisan('voyager:install', ['--with-dummy' => $this->withDummy]);
    }

    public function disableExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, new DisabledTestException());
    }
}

class DisabledTestException extends Handler
{
    public function __construct()
    {
    }

    public function report(Exception $e)
    {
    }

    public function render($request, Exception $e)
    {
        throw $e;
    }
}
