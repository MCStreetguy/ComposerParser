<?php

namespace MCStreetguy\ComposerParser\Service;

/**
 * This class represents a map from packages to versions.
 *
 * @see https://getcomposer.org/doc/04-schema.md#package-links
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 */
class PackageMap implements \Iterator
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var array
     */
    protected $list;

    /**
     * @var int
     */
    protected $position;

    /**
     * Parses the given data and constructs a new instance from it.
     *
     * @param array $data The composer.json partial data
     */
    public function __construct(array $data = [])
    {
        $this->position = 0;
        $this->list = [];
        $this->data = [];

        foreach ($data as $name => $version) {
            $this->data[$name] = $version;

            $this->list[] = [
                'name' => $name,
                'version' => $version
            ];
        }
    }

    /**
     * Resets the iteration to the first element.
     *
     * @see http://php.net/manual/de/iterator.rewind.php
     * @return void
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Gets the current iteration element.
     *
     * @see http://php.net/manual/de/iterator.current.php
     * @return array
     */
    public function current() : array
    {
        return $this->list[$this->position];
    }

    /**
     * Gets the current iteration key.
     *
     * @see http://php.net/manual/de/iterator.key.php
     * @return int
     */
    public function key() : int
    {
        return $this->position;
    }

    /**
     * Steps on to the next iteration element.
     *
     * @see http://php.net/manual/de/iterator.next.php
     * @return void
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * Checks if the current iteration key is valid.
     *
     * @see http://php.net/manual/de/iterator.valid.php
     * @return bool
     */
    public function valid() : bool
    {
        return null !== $this->current();
    }

    /**
     * Gets the original packages map.
     *
     * @return array
     */
    public function getPackages() : array
    {
        return $this->data;
    }

    /**
     * Gets the parsed package map as an array of objects.
     *
     * @return array
     */
    public function getPackagesList() : array
    {
        return $this->list;
    }
}
