<?php

namespace MCStreetguy\ComposerLock;

class Source
{
    protected $type;

    protected $url;

    protected $reference;

    public function __construct(array $options)
    {
        $this->type = (array_key_exists('type', $options) ? $options['type'] : '');
        $this->url = (array_key_exists('url', $options) ? $options['url'] : '');
        $this->reference = (array_key_exists('reference', $options) ? $options['reference'] : '');
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function getUrl() : string
    {
        return $this->url;
    }

    public function getReference() : string
    {
        return $this->reference;
    }
}
