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
        if ($this->disqus->isEnabled()) {
            $pageUrl = $request->url();
            $pageId  = 'base'.implode('.', explode('/', $request->getPathInfo()));

            $this->disqus->setPageUrl($pageUrl)
                         ->setPageId($pageId);
        }

        return $next($request);
    }
}
