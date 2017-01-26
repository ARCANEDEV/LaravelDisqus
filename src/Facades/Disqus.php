<?php namespace Arcanedev\LaravelDisqus\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class     Disqus
 *
 * @package  Arcanedev\LaravelDisqus\Facades
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Disqus extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Arcanedev\LaravelDisqus\Contracts\Disqus::class;
    }
}
