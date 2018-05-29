<?php

namespace MCStreetguy\ComposerJson;

class Author
{
    protected $name;

    protected $email;

    protected $homepage;

    protected $role;

    public function __construct(array $data)
    {
        $this->name = (array_key_exists('name', $data) ? $data['name'] : '');
        $this->email = (array_key_exists('email', $data) ? $data['email'] : '');
        $this->homepage = (array_key_exists('homepage', $data) ? $data['homepage'] : '');
        $this->role = (array_key_exists('role', $data) ? $data['role'] : '');
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getHomepage() : string
    {
        return $this->homepage;
    }

    public function getRole() : string
    {
        return $this->role;
    }
}
