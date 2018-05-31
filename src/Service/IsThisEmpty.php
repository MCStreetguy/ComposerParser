<?php

namespace MCStreetguy\ComposerParser\Service;

abstract class IsThisEmpty
{
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
