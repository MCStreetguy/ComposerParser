<?php

namespace MCStreetguy\ComposerParser\Lockfile;

use MCStreetguy\ComposerParser\Service\AbstractClass;

/**
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 */
class Source extends AbstractClass
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $reference;

    /**
     * Parses the given data and constructs a new instance from it.
     *
     * @param array $data The composer lockfile partial data
     */
    public function __construct(array $data = [])
    {
        $this->type = (array_key_exists('type', $data) ? $data['type'] : '');
        $this->url = (array_key_exists('url', $data) ? $data['url'] : '');
        $this->reference = (array_key_exists('reference', $data) ? $data['reference'] : '');
    }

    /**
     * Get the value of type
     *
     * @return  string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the value of url
     *
     * @return  string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the value of reference
     *
     * @return  string
     */
    public function getReference()
    {
        return $this->reference;
    }
}
