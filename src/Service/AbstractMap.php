<?php

namespace MCStreetguy\ComposerParser\Service;

/**
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 */
abstract class AbstractMap extends IsThisEmpty implements \Iterator, \ArrayAccess
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
     * @var array
     */
    protected $mapKeys;

    /**
     * Parses the given data and constructs a new instance from it.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->position = 0;
        $this->list = [];
        $this->data = $data;

        foreach ($data as $key => $value) {
            $this->list[] = [
                $this->mapKeys['key'] => $key,
                $this->mapKeys['value'] => $value
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
    public function current()
    {
        return $this->list[$this->position];
    }

    /**
     * Gets the current iteration key.
     *
     * @see http://php.net/manual/de/iterator.key.php
     * @return int
     */
    public function key()
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
    public function valid()
    {
        return $this->offsetExists($this->position);
    }

    /**
     * Sets a value on the given offset.
     *
     * @see http://php.net/manual/de/arrayaccess.offsetset.php
     * @param int $offset The desired offset
     * @param mixed $value The value to store
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->list[] = $value;
        } else {
            $this->list[$offset] = $value;
        }
    }

    /**
     * Checks if the given offset exists.
     *
     * @see http://php.net/manual/de/arrayaccess.offsetexists.php
     * @param int $offset The desired offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->list[$offset]);
    }

    /**
     * Unsets the given offset.
     *
     * @see http://php.net/manual/de/arrayaccess.offsetunset.php
     * @param int $offset The desired offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->list[$offset]);
    }

    /**
     * Returns the value for the given offset.
     *
     * @see http://php.net/manual/de/arrayaccess.offsetget.php
     * @param int $offset The desired offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->list[$offset] : null;
    }

    /**
     * Returns the map data.
     *
     * @return array
     */
    public function getData() : array
    {
        return $this->data;
    }

    /**
     * Returns the unmapped data.
     *
     * @return array
     */
    public function getRawData() : array
    {
        return $this->list;
    }

    /**
     * Returns the map keys.
     *
     * @return array
     */
    public function getMapKeys()
    {
        return $this->mapKeys;
    }
}
