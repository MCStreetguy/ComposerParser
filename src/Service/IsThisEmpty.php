<?php

namespace MCStreetguy\ComposerParser\Service;

/**
 * An abstract class that provides an 'isEmpty()' method.
 */
abstract class IsThisEmpty
{
    /**
     * Checks if the current instance is empty by evaluating all properties.
     */
    public function isEmpty()
    {
        foreach ($this as $prop => $value) {
            if (!empty($this->$prop)) {
                return false;
            }
        }

        return true;
    }
}
