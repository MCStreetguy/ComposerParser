<?php

namespace MCStreetguy;

use MCStreetguy\ComposerParser\Json;
use MCStreetguy\ComposerParser\Lockfile;

abstract class ComposerFactory
{
    /**
     * Reads the given file and automatically parses it to a ComposerJson or ComposerLock instance.
     *
     * @param string $path The file to parse
     * @return ComposerJson|ComposerLock
     */
    public static function parse(string $path)
    {
        if (preg_match('/composer\.json$/', $path)) {
            return self::parseComposerJson($path);
        } elseif (preg_match('/composer\.lock$/', $path)) {
            return self::parseComposerLock($path);
        } else {
            throw new \InvalidArgumentException("File at path '$path' is neither a composer.lock or a composer.json file!", 1527613100);
        }
    }

    public static function parseComposerJson(string $path) : ComposerJson
    {
        $content = self::readFile($path);

        return new ComposerJson($content);
    }

    public static function parseComposerLock(string $path) : ComposerLock
    {
        $content = self::readFile($path);

        return new ComposerLock($content);
    }

    protected static function readFile(string $path) : string
    {
        if (!\is_file($path) || !\is_readable($path)) {
            throw new \InvalidArgumentException("File at path '$path' does not exist or is not readable!", 1527613092);
        }

        return file_get_contents($path);
    }
}
