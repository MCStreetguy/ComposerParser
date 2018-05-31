<?php

namespace MCStreetguy\ComposerParser\Service;

/**
 * This class represents a map from packages to versions.
 *
 * @see https://getcomposer.org/doc/04-schema.md#package-links
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 */
class PackageMap extends AbstractMap implements \Iterator, \ArrayAccess
{
    /**
     * @see AbstractMap::__construct
     * @param array $data The composer.json partial data
     */
    public function __construct(array $data = [])
    {
        $this->mapKeys = [
            'key' => 'package',
            'value' => 'version'
        ];

        parent::__construct($data);
    }

    /**
     * Gets the parsed package map as an array of objects.
     *
     * @return array
     */
    public function getPackages() : array
    {
        return $this->getRawData();
    }
}
