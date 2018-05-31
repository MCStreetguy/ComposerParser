<?php

namespace MCStreetguy\ComposerParser\Service;

/**
 * This class represents a map from namespaces to sources.
 *
 * @see https://getcomposer.org/doc/04-schema.md#psr-4
 * @see https://getcomposer.org/doc/04-schema.md#psr-0
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 */
class NamespaceMap extends AbstractMap implements \Iterator, \ArrayAccess
{
    /**
     * @see AbstractMap::__construct
     * @param array $data The composer.json partial data
     */
    public function __construct(array $data = [])
    {
        $this->mapKeys = [
            'key' => 'namespace',
            'value' => 'source'
        ];

        parent::__construct($data);
    }

    /**
     * Gets the parsed namespace map as an array of objects.
     *
     * @return array
     */
    public function getNamespaces() : array
    {
        return $this->getRawData();
    }
}
