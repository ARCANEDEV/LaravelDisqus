<?php namespace Arcanedev\LaravelDisqus\Tests;

use Arcanedev\LaravelDisqus\Http\Middleware\DisqusMiddleware;
use Orchestra\Testbench\TestCase as BaseTestCase;

/**
 * Class     TestCase
 *
 * @package  Arcanedev\LaravelDisqus\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class TestCase extends BaseTestCase
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        $this->app->loadDeferredProviders();
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Arcanedev\LaravelDisqus\LaravelDisqusServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            \Arcanedev\LaravelDisqus\Facades\Disqus::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $this->registerRoutes($app['router']);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register routes.
     *
     * @param  \Illuminate\Routing\Router  $router
     */
    private function registerRoutes($router)
    {
        $router->aliasMiddleware('disqus', DisqusMiddleware::class);

        $router->group(['middleware' => 'disqus'], function ($router) {
            /** @var  \Illuminate\Routing\Router  $router */
            $router->get('/', function () {
                return 'Homepage';
            });

            $router->get('post-one', function () {
                return 'Post one';
            });
        });
    }
}
