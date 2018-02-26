<?php namespace Arcanedev\LaravelDisqus\Tests\Http\Middleware;

use Arcanedev\LaravelDisqus\Tests\TestCase;

/**
 * Class     DisqusMiddlewareTest
 *
 * @package  Arcanedev\LaravelDisqus\Tests\Http\Middleware
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DisqusMiddlewareTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_set_page_url_and_page_id_via_middleware()
    {
        $disqus = disqus();

        // Disabled
        $this->get('/');

        static::assertEmpty($disqus->pageUrl());
        static::assertEmpty($disqus->pageId());

        // Enabled
        $disqus->enable();

        $this->get('/');

        static::assertSame('http://localhost', $disqus->pageUrl());
        static::assertSame('base.home', $disqus->pageId());

        $this->get('post-one');

        static::assertSame('http://localhost/post-one', $disqus->pageUrl());
        static::assertSame('base.post-one', $disqus->pageId());
    }
}
