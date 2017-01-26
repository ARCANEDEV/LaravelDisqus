<?php

if ( ! function_exists('disqus')) {
    /**
     * @return \Arcanedev\LaravelDisqus\Contracts\Disqus
     */
    function disqus() {
        return app(Arcanedev\LaravelDisqus\Contracts\Disqus::class);
    }
}
