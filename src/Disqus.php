<?php namespace Arcanedev\LaravelDisqus;

use Arcanedev\LaravelDisqus\Contracts\Disqus as DisqusContract;
use Illuminate\Support\Arr;

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
     * The Page ID property.
     *
     * @var string
     */
    protected $pageId = '';

    /**
     * The Language property.
     *
     * @var string
     */
    protected $language;

    /**
     * Disqus enabled status.
     *
     * @var bool
     */
    protected $enabled = false;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Disqus constructor.
     *
     * @param  array  $options
     */
    public function __construct(array $options = [])
    {
        $this->setUsername(Arr::get($options, 'username', ''))
             ->setLanguage(Arr::get($options, 'language', null));
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the disqus's username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

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
     * Get the Page URL.
     *
     * @return string
     */
    public function pageUrl()
    {
        return $this->pageUrl;
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
     * Get the Page ID.
     *
     * @return string
     */
    public function pageId()
    {
        return $this->pageId;
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
     * Get the language.
     *
     * @return string
     */
    public function language()
    {
        return $this->language;
    }

    /**
     * Set the language.
     *
     * @param  string  $language
     *
     * @return self
     */
    public function setLanguage($language)
    {
        $this->language = $language;

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
        $content = $this->isEnabled()
            ? view('laravel-disqus::script', $this->getScriptParams())->render()
            : '';

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

    /**
     * Get the script parameters.
     *
     * @return array
     */
    private function getScriptParams()
    {
        return [
            'pageUrl'  => $this->pageUrl(),
            'pageId'   => $this->pageId(),
            'username' => $this->username(),
            'language' => $this->language(),
        ];
    }
}
