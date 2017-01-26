<?php namespace Arcanedev\LaravelDisqus\Contracts;

/**
 * Interface  Disqus
 *
 * @package   Arcanedev\LaravelDisqus\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Disqus
{
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
    public function setUsername($username);

    /**
     * Set the disqus's enabled property.
     *
     * @param  bool  $enabled
     *
     * @return self
     */
    public function setEnabled($enabled);

    /**
     * Set the page url.
     *
     * @param  string  $pageUrl
     *
     * @return self
     */
    public function setPageUrl($pageUrl);

    /**
     * Set the Page ID.
     *
     * @param  string  $pageId
     *
     * @return self
     */
    public function setPageId($pageId);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
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
     * Check if Disqus is enabled.
     *
     * @return bool
     */
    public function isEnabled();
}
