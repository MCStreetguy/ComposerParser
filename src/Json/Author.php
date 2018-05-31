<?php

namespace MCStreetguy\ComposerParser\Json;

use MCStreetguy\ComposerParser\Service\AbstractClass;

/**
 * This class represents an entry from the "authors" section in the composer.json schema.
 *
 * @see https://getcomposer.org/doc/04-schema.md#authors
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 */
class Author extends AbstractClass
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $homepage;

    /**
     * @var string
     */
    protected $role;

    /**
     * Parses the given data and constructs a new instance from it.
     *
     * @param array $data The composer.json partial data
     */
    public function __construct(array $data = [])
    {
        $this->name = (array_key_exists('name', $data) ? $data['name'] : '');
        $this->email = (array_key_exists('email', $data) ? $data['email'] : '');
        $this->homepage = (array_key_exists('homepage', $data) ? $data['homepage'] : '');
        $this->role = (array_key_exists('role', $data) ? $data['role'] : '');
    }

    /**
     * Gets the authors name.
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Gets the authors email.
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * Gets the authors homepage url.
     * @return string
     */
    public function getHomepage() : string
    {
        return $this->homepage;
    }

    /**
     * Gets the authors role.
     * @return string
     */
    public function getRole() : string
    {
        return $this->role;
    }
}
