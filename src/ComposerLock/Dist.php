<?php

namespace MCStreetguy\ComposerLock;

class Dist
{
    protected $type;

    protected $url;

    protected $reference;

    protected $shasum;

    public function __construct(array $options)
    {
        $this->type = (array_key_exists('type', $options) ? $options['type'] : '');
        $this->url = (array_key_exists('url', $options) ? $options['url'] : '');
        $this->reference = (array_key_exists('reference', $options) ? $options['reference'] : '');
        $this->shasum = (array_key_exists('shasum', $options) ? $options['shasum'] : '');
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

    public function getShaSum() : string
    {
        return $this->shasum;
    }
}
