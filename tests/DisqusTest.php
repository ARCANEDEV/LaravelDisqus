<?php namespace Arcanedev\LaravelDisqus\Tests;

/**
 * Class     DisqusTest
 *
 * @package  Arcanedev\LaravelDisqus\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DisqusTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var \Arcanedev\LaravelDisqus\Contracts\Disqus */
    protected $disqus;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp()
    {
        parent::setUp();

        $this->disqus = $this->app->make(\Arcanedev\LaravelDisqus\Contracts\Disqus::class);
    }

    public function tearDown()
    {
        unset($this->disqus);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\LaravelDisqus\Contracts\Disqus::class,
            \Arcanedev\LaravelDisqus\Disqus::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->disqus);
        }

        static::assertFalse($this->disqus->isEnabled());
    }

    /** @test */
    public function it_can_be_instantiated_via_helper()
    {
        $disqus = disqus();

        $expectations = [
            \Arcanedev\LaravelDisqus\Contracts\Disqus::class,
            \Arcanedev\LaravelDisqus\Disqus::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $disqus);
        }

        static::assertFalse($disqus->isEnabled());
    }

    /** @test */
    public function it_can_be_enabled_and_disabled()
    {
        static::assertFalse($this->disqus->isEnabled());

        $this->disqus->enable();

        static::assertTrue($this->disqus->isEnabled());

        $this->disqus->disable();

        static::assertFalse($this->disqus->isEnabled());
    }

    /** @test */
    public function it_can_set_and_get_username()
    {
        static::assertEmpty($this->disqus->username());

        $this->disqus->setUsername($username = 'ARCANEDEV');

        static::assertSame($username, $this->disqus->username());
    }

    /** @test */
    public function it_can_set_and_get_language()
    {
        static::assertNull($this->disqus->language());

        $this->disqus->setLanguage($language = 'fr');

        static::assertSame($language, $this->disqus->language());
    }

    /** @test */
    public function it_can_set_and_get_page_url()
    {
        static::assertEmpty($this->disqus->pageUrl());

        $this->disqus->setPageUrl($pageUrl = 'http://github.com/ARCANEDEV');

        static::assertSame($pageUrl, $this->disqus->pageUrl());
    }

    /** @test */
    public function it_can_set_and_get_page_id()
    {
        static::assertEmpty($this->disqus->pageId());

        $this->disqus->setPageId($pageId = 'page-github-arcanedev');

        static::assertSame($pageId, $this->disqus->pageId());
    }

    /** @test */
    public function it_can_render()
    {
        // Disabled
        $actual = $this->disqus->render();

        static::assertInstanceOf(\Illuminate\Support\HtmlString::class, $actual);
        static::assertEmpty($actual->toHtml());
        static::assertEmpty((string) $actual);

        // Enabled
        $this->disqus->enable();

        $actual   = $this->disqus->render();
        $expected = '<div id="disqus_thread"></div>';

        static::assertSame($expected, $actual->toHtml());
        static::assertSame($expected, (string) $actual);
    }

    /** @test */
    public function it_can_render_script()
    {
        // Disabled
        $actual = $this->disqus->script();

        static::assertInstanceOf(\Illuminate\Support\HtmlString::class, $actual);
        static::assertEmpty($actual->toHtml());
        static::assertEmpty((string) $actual);

        // Enabled
        $this->disqus->enable();

        $actual   = $this->disqus->script();
        $expected = file_get_contents(__DIR__ . '/fixtures/scripts/disqus-without-params.html');

        static::assertSame($expected, $actual->toHtml());
        static::assertSame($expected, (string) $actual);

        // With basic parameters
        $this->disqus->setUsername($username = 'ARCANEDEV');
        $this->disqus->setPageUrl($pageUrl = 'http://github.com/ARCANEDEV');
        $this->disqus->setPageId($pageId = 'page-github-arcanedev');

        $actual   = $this->disqus->script();
        $expected = file_get_contents(__DIR__ . '/fixtures/scripts/disqus-with-params.html');

        static::assertSame($expected, $actual->toHtml());
        static::assertSame($expected, (string) $actual);

        // How about language ?
        $this->disqus->setLanguage($language = 'fr');

        $actual   = $this->disqus->script();
        $expected = file_get_contents(__DIR__ . '/fixtures/scripts/disqus-with-params-and-language.html');

        static::assertSame($expected, $actual->toHtml());
        static::assertSame($expected, (string) $actual);
    }
}
