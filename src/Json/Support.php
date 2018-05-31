<?php

namespace MCStreetguy\ComposerParser\Json;

use MCStreetguy\ComposerParser\Service\AbstractClass;

/**
 * This class represents the "support" section from the composer.json schema.
 *
 * @see https://getcomposer.org/doc/04-schema.md#support
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 */
class Support extends AbstractClass
{
    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $issues;

    /**
     * @var string
     */
    protected $forum;

    /**
     * @var string
     */
    protected $wiki;

    /**
     * @var string
     */
    protected $irc;

    /**
     * @var string
     */
    protected $source;

    /**
     * @var string
     */
    protected $docs;

    /**
     * @var string
     */
    protected $rss;

    /**
     * Parses the given data and constructs a new instance from it.
     *
     * @param array $data The composer.json partial data
     */
    public function __construct(array $data = [])
    {
        $this->email = (array_key_exists('email', $data) ? $data['email'] : '');
        $this->issues = (array_key_exists('issues', $data) ? $data['issues'] : '');
        $this->forum = (array_key_exists('forum', $data) ? $data['forum'] : '');
        $this->wiki = (array_key_exists('wiki', $data) ? $data['wiki'] : '');
        $this->irc = (array_key_exists('irc', $data) ? $data['irc'] : '');
        $this->source = (array_key_exists('source', $data) ? $data['source'] : '');
        $this->docs = (array_key_exists('docs', $data) ? $data['docs'] : '');
        $this->rss = (array_key_exists('rss', $data) ? $data['rss'] : '');
    }

    /**
     * Gets the email address.
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * Gets the issue page url.
     * @return string
     */
    public function getIssues() : string
    {
        return $this->issues;
    }

    /**
     * Gets the forum url.
     * @return string
     */
    public function getForum() : string
    {
        return $this->forum;
    }

    /**
     * Gets the wiki url.
     * @return string
     */
    public function getWiki() : string
    {
        return $this->wiki;
    }

    /**
     * Gets the irc chat address.
     * @return string
     */
    public function getIrc() : string
    {
        return $this->irc;
    }

    /**
     * Gets the code source url.
     * @return string
     */
    public function getSource() : string
    {
        return $this->source;
    }

    /**
     * Gets the documentation url.
     * @return string
     */
    public function getDocs() : string
    {
        return $this->docs;
    }

    /**
     * Gets the rss feed address.
     * @return string
     */
    public function getRss() : string
    {
        return $this->rss;
    }
}
