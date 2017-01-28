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
    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_set_page_url_and_page_id_via_middleware()
    {
        $disqus = disqus();

        // Disabled
        $this->get('/');

        $this->assertEmpty($disqus->pageUrl());
        $this->assertEmpty($disqus->pageId());

        // Enabled
        $disqus->enable();

        $this->get('/');

        $this->assertSame('http://localhost', $disqus->pageUrl());
        $this->assertSame('base.home', $disqus->pageId());

        $this->get('post-one');

        $this->assertSame('http://localhost/post-one', $disqus->pageUrl());
        $this->assertSame('base.post-one', $disqus->pageId());
    }
}