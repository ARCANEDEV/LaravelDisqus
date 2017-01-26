<?php namespace Arcanedev\LaravelDisqus;

use Arcanedev\LaravelDisqus\Contracts\Disqus as DisqusContract;

/**
 * Class     Disqus
 *
 * @package  Arcanedev\LaravelDisqus
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Disqus implements DisqusContract
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The Username property.
     *
     * @var string
     */
    protected $username = '';

    /**
     * The Page URL property.
     *
     * @var string
     */
    protected $pageUrl = '';

    /**
     * Disqus enabled status.
     *
     * @var bool
     */
    protected $enabled = false;

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the disqus's username property.
     *
     * @param  string  $username
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set the Page URL.
     *
     * @param  string  $pageUrl
     *
     * @return self
     */
    public function setPageUrl($pageUrl)
    {
        $this->pageUrl = $pageUrl;

        return $this;
    }

    /**
     * Set the Page ID.
     *
     * @param  string  $pageId
     *
     * @return self
     */
    public function setPageId($pageId)
    {
        $this->pageId = $pageId;

        return $this;
    }

    /**
     * Set the disqus's enabled property.
     *
     * @param  bool  $enabled
     *
     * @return self
     */
    public function setEnabled($enabled)
    {
        $this->enabled = (bool) $enabled;

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Render the Disqus thread.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function render()
    {
        return $this->toHtml(
            $this->isEnabled() ? '<div id="disqus_thread"></div>' : ''
        );
    }

    /**
     * Generate Disqus js script.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function script()
    {
        $content = '';

        if ($this->isEnabled()) {
            $content = view('laravel-disqus::script', [
                'pageUrl'  => $this->pageUrl,
                'pageId'   => '',
                'username' => $this->username,
            ])->render();
        }

        return $this->toHtml($content);
    }

    /**
     * Enable Disqus.
     *
     * @return self
     */
    public function enable()
    {
        return $this->setEnabled(true);
    }

    /**
     * Disable Disqus.
     *
     * @return self
     */
    public function disable()
    {
        return $this->setEnabled(false);
    }

    /**
     * Check if Disqus is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Convert the string content to Html Object.
     *
     * @param  string  $content
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function toHtml($content)
    {
        return new \Illuminate\Support\HtmlString($content);
    }
}
