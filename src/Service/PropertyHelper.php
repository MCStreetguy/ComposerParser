<?php

namespace MCStreetguy\ComposerParser\Service;

/**
 * A helper class for property <-> json key conversion.
 *
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 */
abstract class PropertyHelper
{
    /**
     * Converts a classPropertyName to a json-schema-key.
     *
     * @param string $property The property name in camelCase
     * @return string The json key in kebab-case
     */
    public static function convertPropertyToJsonKey(string $property) : string
    {
        $key = preg_replace('/(?<=\w)[A-Z]/', "-$1", $property);
        $key = strtolower($key);

        return $key;
    }

    /**
     * Convert a json-schema-key to a classPropertyName.
     *
     * @param string $key The json ke yin kebab-case
     * @return string The property name in camelCase
     */
    public static function convertJsonKeyToProperty(string $key) : string
    {
        $property = preg_replace_callback('/(?<=\w)-([a-z])/', function (array $matches) {
            return \strtoupper($matches[1]);
        }, $key);
        
        return $property;
    }
}
