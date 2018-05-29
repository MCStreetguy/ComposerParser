<?php

namespace MCStreetguy\ComposerJson;

class Support
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
    public function __construct(array $data)
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

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getIssues() : string
    {
        return $this->issues;
    }

    public function getForum() : string
    {
        return $this->forum;
    }

    public function getWiki() : string
    {
        return $this->wiki;
    }

    public function getIrc() : string
    {
        return $this->irc;
    }

    public function getSource() : string
    {
        return $this->source;
    }

    public function getDocs() : string
    {
        return $this->docs;
    }

    public function getRss() : string
    {
        return $this->rss;
    }
}
