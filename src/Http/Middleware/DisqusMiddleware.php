<?php namespace Arcanedev\LaravelDisqus\Http\Middleware;

use Arcanedev\LaravelDisqus\Contracts\Disqus;
use Closure;

/**
 * Class     DisqusMiddleware
 *
 * @package  Arcanedev\LaravelDisqus\Http\Middleware
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DisqusMiddleware
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The Disqus instance.
     *
     * @var  \Arcanedev\LaravelDisqus\Contracts\Disqus
     */
    protected $disqus;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * DisqusMiddleware constructor.
     *
     * @param  \Arcanedev\LaravelDisqus\Contracts\Disqus  $disqus
     */
    public function __construct(Disqus $disqus)
    {
        $this->disqus = $disqus;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->disqus->isEnabled())
            $this->handleDisqus($request);

        return $next($request);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Handle Disqus.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    protected function handleDisqus($request)
    {
        $this->disqus->setPageUrl($request->url())
                     ->setPageId($this->getPageId($request));
    }

    /**
     * Get the page id.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string
     */
    protected function getPageId($request)
    {
        $path = implode('.', explode('/', $request->getPathInfo()));

        return 'base'.($path === '.' ? $path.'home' : $path);
    }
}
