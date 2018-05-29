<?php

namespace MCStreetguy\ComposerJson\Service;

/**
 * This class represents a map from namespaces to sources.
 *
 * @see https://getcomposer.org/doc/04-schema.md#psr-4
 * @see https://getcomposer.org/doc/04-schema.md#psr-0
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 */
class NamespaceMap implements Iterator
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

        foreach ($data as $namespace => $source) {
            $this->data[$namespace] = $source;

            $this->list[] = [
                'namespace' => $namespace,
                'source' => $source
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
     * Gets the original namespace map.
     *
     * @return array
     */
    public function getNamespaces() : array
    {
        return $this->data;
    }

    /**
     * Gets the parsed namespace map as an array of objects.
     *
     * @return array
     */
    public function getNamespaceList() : array
    {
        return $this->list;
    }
}
