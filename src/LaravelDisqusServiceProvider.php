<?php namespace Arcanedev\LaravelDisqus;

use Arcanedev\Support\PackageServiceProvider;
use Illuminate\Contracts\Http\Kernel;

/**
 * Class     LaravelDisqusServiceProvider
 *
 * @package  Arcanedev\LaravelDisqus
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LaravelDisqusServiceProvider extends PackageServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'laravel-disqus';

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the base path of the package.
     *
     * @return string
     */
    public function getBasePath()
    {
        return dirname(__DIR__);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerConfig();

        $this->singleton(Contracts\Disqus::class, function ($app) {
            /** @var  \Illuminate\Contracts\Config\Repository  $config */
            $config = $app['config'];
            $disqus = new Disqus;

            $disqus->setEnabled($config->get('laravel-disqus.enabled', false))
                   ->setUsername($config->get('laravel-disqus.username', ''));

            return $disqus;
        });
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->publishConfig();
        $this->publishViews();

        $this->registerMiddleware();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            Contracts\Disqus::class,
        ];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register Disqus Middleware.
     */
    private function registerMiddleware()
    {
        if ($middleware = $this->config()->get('laravel-disqus.middleware')) {
            $this->app[Kernel::class]->pushMiddleware($middleware);
        }
    }
}
