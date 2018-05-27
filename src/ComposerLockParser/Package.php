<?php

namespace MCStreetguy\ComposerLockParser;

class Package
{
    public function __construct(array $config)
    {
        $this->name = (array_key_exists('name', $config) ? $config['name'] : '');
        $this->version = (array_key_exists('version', $config) ? $config['version'] : '');
        $this->type = (array_key_exists('type', $config) ? $config['type'] : '');
        $this->authors = (array_key_exists('authors', $config) ? $config['authors'] : []);
        $this->description = (array_key_exists('description', $config) ? $config['description'] : '');
        $this->homepage = (array_key_exists('homepage', $config) ? $config['homepage'] : '');
        $this->keywords = (array_key_exists('keywords', $config) ? $config['keywords'] : []);
        $this->time = (array_key_exists('time', $config) ? $config['time'] : '');
        $this->extra = (array_key_exists('extra', $config) ? $config['extra'] : []);
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getVersion() : string
    {
        return $this->version;
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function getAuthors() : array
    {
        return $this->authors;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function getHomepage() : string
    {
        return $this->homepage;
    }

    public function getKeywords() : array
    {
        return $this->keywords;
    }

    public function getTime() : string
    {
        return $this->time;
    }

    public function getExtra() : array
    {
        return $this->extra;
    }
}
