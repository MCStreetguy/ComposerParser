<?php

namespace MCStreetguy\ComposerParser;

abstract class Factory
{
    /**
     * Analyses the given file and automatically parses it to a ComposerJson or Lockfile instance.
     *
     * @param string $path The file to parse
     * @return ComposerJson|Lockfile
     */
    public static function parse(string $path)
    {
        if (preg_match('/composer\.json$/', $path)) {
            return self::parseComposerJson($path);
        } elseif (preg_match('/composer\.lock$/', $path)) {
            return self::parseLockfile($path);
        }

        throw new \InvalidArgumentException("File at path '$path' is neither a composer.lock or a composer.json file!", 1527613100);
    }

    /**
     * Parses the given file into a ComposrJson instance.
     *
     * @param string $path The composer.json path
     * @return ComposerJson
     * @throws InvalidArgumentException
     */
    public static function parseComposerJson(string $path) : ComposerJson
    {
        $content = self::readJsonFile($path);

        return new ComposerJson($content);
    }

    /**
     * Parses the given file into a Lockfile instance.
     *
     * @param string $path The composer.lock path
     * @return Lockfile
     * @throws InvalidArgumentException
     */
    public static function parseLockfile(string $path) : Lockfile
    {
        $content = self::readJsonFile($path);

        return new Lockfile($content);
    }

    /**
     * Reads and decodes the give json file.
     *
     * @param string $path The file path to read
     * @return array The parsed data
     * @throws InvalidArgumentException
     */
    protected static function readJsonFile(string $path) : array
    {
        if (!\is_file($path) || !\is_readable($path)) {
            throw new \InvalidArgumentException("File at path '$path' does not exist or is not readable!", 1527613092);
        }

        $content = file_get_contents($path);
        $object = json_decode($content, true);
        return $object;
    }
}
