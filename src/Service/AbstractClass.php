<?php

namespace MCStreetguy\ComposerParser\Service;

abstract class AbstractClass extends IsThisEmpty
{
    public function __get(string $name) : mixed
    {
        if (\property_exists($this, $name)) {
            return $this->$name;
        }

        return null;
    }

    public function __isset(string $name) : bool
    {
        return (
            \property_exists($this, $name) &&
            !empty($this->$name)
        );
    }
}
