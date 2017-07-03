<?php namespace Arcanedev\LaravelDisqus\Contracts;

/**
 * Interface  Disqus
 *
 * @package   Arcanedev\LaravelDisqus\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Disqus
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the disqus's username property.
     *
     * @return string
     */
    public function username();

    /**
     * Set the disqus's username property.
     *
     * @param  string  $username
     *
     * @return self
     */
    public function setUsername($username);

    /**
     * Get the Page URL.
     *
     * @return string
     */
    public function pageUrl();

    /**
     * Set the page url.
     *
     * @param  string  $pageUrl
     *
     * @return self
     */
    public function setPageUrl($pageUrl);

    /**
     * Get the Page ID.
     *
     * @return string
     */
    public function pageId();

    /**
     * Set the Page ID.
     *
     * @param  string  $pageId
     *
     * @return self
     */
    public function setPageId($pageId);

    /**
     * Get the language.
     *
     * @return string
     */
    public function language();

    /**
     * Set the language.
     *
     * @param  string  $language
     *
     * @return self
     */
    public function setLanguage($language);

    /**
     * Set the disqus's enabled property.
     *
     * @param  bool  $enabled
     *
     * @return self
     */
    public function setEnabled($enabled);

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Render the Disqus thread.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function render();

    /**
     * Generate Disqus js script.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function script();

    /**
     * Enable Disqus.
     *
     * @return self
     */
    public function enable();

    /**
     * Disable Disqus.
     *
     * @return self
     */
    public function disable();

    /**
     * Check if Disqus is enabled.
     *
     * @return bool
     */
    public function isEnabled();
}
