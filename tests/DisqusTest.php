<?php namespace Arcanedev\LaravelDisqus\Tests;

/**
 * Class     DisqusTest
 *
 * @package  Arcanedev\LaravelDisqus\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DisqusTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var \Arcanedev\LaravelDisqus\Contracts\Disqus */
    protected $disqus;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
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

    /* ------------------------------------------------------------------------------------------------
     |  Tests
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\LaravelDisqus\Contracts\Disqus::class,
            \Arcanedev\LaravelDisqus\Disqus::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->disqus);
        }

        $this->assertFalse($this->disqus->isEnabled());
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
            $this->assertInstanceOf($expected, $disqus);
        }

        $this->assertFalse($disqus->isEnabled());
    }

    /** @test */
    public function it_can_be_enabled_and_disabled()
    {
        $this->assertFalse($this->disqus->isEnabled());

        $this->disqus->enable();

        $this->assertTrue($this->disqus->isEnabled());

        $this->disqus->disable();

        $this->assertFalse($this->disqus->isEnabled());
    }

    /** @test */
    public function it_can_set_and_get_username()
    {
        $this->assertEmpty($this->disqus->username());

        $this->disqus->setUsername($username = 'ARCANEDEV');

        $this->assertSame($username, $this->disqus->username());
    }

    /** @test */
    public function it_can_set_and_get_language()
    {
        $this->assertNull($this->disqus->language());

        $this->disqus->setLanguage($language = 'fr');

        $this->assertSame($language, $this->disqus->language());
    }

    /** @test */
    public function it_can_set_and_get_page_url()
    {
        $this->assertEmpty($this->disqus->pageUrl());

        $this->disqus->setPageUrl($pageUrl = 'http://github.com/ARCANEDEV');

        $this->assertSame($pageUrl, $this->disqus->pageUrl());
    }

    /** @test */
    public function it_can_set_and_get_page_id()
    {
        $this->assertEmpty($this->disqus->pageId());

        $this->disqus->setPageId($pageId = 'page-github-arcanedev');

        $this->assertSame($pageId, $this->disqus->pageId());
    }

    /** @test */
    public function it_can_render()
    {
        // Disabled
        $actual = $this->disqus->render();

        $this->assertInstanceOf(\Illuminate\Support\HtmlString::class, $actual);
        $this->assertEmpty($actual->toHtml());
        $this->assertEmpty((string) $actual);

        // Enabled
        $this->disqus->enable();

        $actual   = $this->disqus->render();
        $expected = '<div id="disqus_thread"></div>';

        $this->assertSame($expected, $actual->toHtml());
        $this->assertSame($expected, (string) $actual);
    }

    /** @test */
    public function it_can_render_script()
    {
        // Disabled
        $actual = $this->disqus->script();

        $this->assertInstanceOf(\Illuminate\Support\HtmlString::class, $actual);
        $this->assertEmpty($actual->toHtml());
        $this->assertEmpty((string) $actual);

        // Enabled
        $this->disqus->enable();

        $actual   = $this->disqus->script();
        $expected = <<<CDATA
<script>
    var disqus_config = function () {
    };
    (function() {
        // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');

        s.src = '//.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href=\"https://disqus.com/?ref_noscript\" rel=\"nofollow\">comments powered by Disqus.</a></noscript>

CDATA;

        $this->assertSame($expected, $actual->toHtml());
        $this->assertSame($expected, (string) $actual);

        // With basic parameters
        $this->disqus->setUsername($username = 'ARCANEDEV');
        $this->disqus->setPageUrl($pageUrl = 'http://github.com/ARCANEDEV');
        $this->disqus->setPageId($pageId = 'page-github-arcanedev');

        $actual   = $this->disqus->script();
        $expected = <<<CDATA
<script>
    var disqus_config = function () {
        this.page.url = '$pageUrl';
        this.page.identifier = '$pageId';
    };
    (function() {
        // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');

        s.src = '//$username.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href=\"https://disqus.com/?ref_noscript\" rel=\"nofollow\">comments powered by Disqus.</a></noscript>

CDATA;

        $this->assertSame($expected, $actual->toHtml());
        $this->assertSame($expected, (string) $actual);

        // How about language ?
        $this->disqus->setLanguage($language = 'fr');

        $actual   = $this->disqus->script();
        $expected = <<<CDATA
<script>
    var disqus_config = function () {
        this.page.url = '$pageUrl';
        this.page.identifier = '$pageId';
        this.language = 'fr';
    };
    (function() {
        // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');

        s.src = '//$username.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href=\"https://disqus.com/?ref_noscript\" rel=\"nofollow\">comments powered by Disqus.</a></noscript>

CDATA;

        $this->assertSame($expected, $actual->toHtml());
        $this->assertSame($expected, (string) $actual);
    }
}
