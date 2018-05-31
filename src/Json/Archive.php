<?php

namespace MCStreetguy\ComposerParser\Json;

use MCStreetguy\ComposerParser\Service\AbstractClass;

/**
 * This class represents the "autoload" section in the composer.json schema.
 *
 * @see https://getcomposer.org/doc/04-schema.md#archive
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 */
class Archive extends AbstractClass
{
    /**
     * @var array
     */
    protected $exclude;

    /**
     * Parses the given data and constructs a new instance from it.
     *
     * @param array $data The composer.json partial data
     */
    public function __construct(array $data = [])
    {
        $this->exclude = (array_key_exists('exclude', $data) ? $data['exclude'] : []);
    }

    /**
     * Get the value of exclude
     *
     * @return  array
     */
    public function getExclude()
    {
        return $this->exclude;
    }
}
