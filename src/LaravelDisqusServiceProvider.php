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
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'laravel-disqus';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register()
    {
        parent::register();

        $this->registerConfig();

        $this->singleton(Contracts\Disqus::class, function ($app) {
            /** @var  \Illuminate\Contracts\Config\Repository  $config */
            $config = $app['config'];

            return tap(new Disqus($config->get('laravel-disqus.options', [])), function (Contracts\Disqus $disqus) use ($config) {
                $disqus->setEnabled($config->get('laravel-disqus.enabled', false));
            });
        });
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        parent::boot();

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

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
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
