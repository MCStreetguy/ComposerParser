<?php

namespace MCStreetguy\ComposerParser\Json;

use MCStreetguy\ComposerParser\Json;

/**
 * This class represents an entry from the "repositories" section in the composer.json schema.
 *
 * @see https://getcomposer.org/doc/04-schema.md#repositories
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 */
class Repository
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
     * @var array
     */
    protected $options;

    /**
     * @var ComposerJson|null
     */
    protected $package;

    public function __construct(array $data = [])
    {
        $this->type = (array_key_exists('type', $data) ? $data['type'] : '');
        $this->url = (array_key_exists('url', $data) ? $data['url'] : '');
        $this->options = (array_key_exists('options', $data) ? $data['options'] : []);

        $this->package = (array_key_exists('package', $data) ? new ComposerJson($data['pacakge']) : null);
    }

    /**
     * Gets the type of the repository.
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }

    /**
     * Gets the url of the repository.
     * @return string
     */
    public function getUrl() : string
    {
        return $this->url;
    }

    /**
     * Gets the additional options of the repository.
     * @return array
     */
    public function getOptions() : string
    {
        return $this->options;
    }

    /**
     * Gets the parsed "package" key of the repository.
     * @return ComposerJson|null
     */
    public function getPackage() : ComposerJson
    {
        return $this->package;
    }
}
