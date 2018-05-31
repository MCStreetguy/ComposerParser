<?php

namespace MCStreetguy\ComposerParser\Service;

/**
 * An improved standard class.
 */
abstract class AbstractClass extends IsThisEmpty
{
    /**
     * @see http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __get(string $name) : mixed
    {
        if (\property_exists($this, $name)) {
            return $this->$name;
        }

        return null;
    }

    /**
     * @see http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __isset(string $name) : bool
    {
        return (
            \property_exists($this, $name) &&
            !empty($this->$name)
        );
    }
}
