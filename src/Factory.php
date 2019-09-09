<?php

namespace MCStreetguy\ComposerParser;

/**
 * A factory class for instantiation of the ComposerJson and Lockfile classes.
 *
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 */
class Factory
{
    public function __call(string $name, array $arguments)
    {
        if (\method_exists(self, $name)) {
            return self::$name($arguments[0]);
        }

        throw new RuntimeException("Cannot call $name on " . get_class() . ", method does not exist!", 1527984626);
    }

    /**
     * Analyses the given file and automatically parses it to a ComposerJson or Lockfile instance.
     *
     * @param string $path The file to parse
     * @param bool $ignoreGlobal Ignore the global configuration directives
     * @return ComposerJson|Lockfile
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public static function parse(string $path, bool $ignoreGlobal = false)
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
     * @param bool $ignoreGlobal Ignore the global configuration directives
     * @return ComposerJson
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public static function parseComposerJson(string $path, bool $ignoreGlobal = false): ComposerJson
    {
        $content = self::readJsonFile($path);

        if ($ignoreGlobal === false) {
            $globalConfig = self::resolveGlobalConfiguration();
            $content = \array_merge_recursive($globalConfig, $content);
        }

        return new ComposerJson($content);
    }

    /**
     * Parses the given file into a Lockfile instance.
     *
     * @param string $path The composer.lock path
     * @param bool $ignoreGlobal Ignore the global configuration directives
     * @return Lockfile
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public static function parseLockfile(string $path, bool $ignoreGlobal = false): Lockfile
    {
        $content = self::readJsonFile($path);

        if ($ignoreGlobal === false) {
            $globalConfig = self::resolveGlobalConfiguration();
            $content = \array_merge_recursive($globalConfig, $content);
        }

        return new Lockfile($content);
    }

    /**
     * Reads and decodes the give json file.
     *
     * @param string $path The file path to read
     * @return array The parsed data
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    protected static function readJsonFile(string $path): array
    {
        if (!\is_file($path) || !\is_readable($path)) {
            throw new \InvalidArgumentException("File at path '$path' does not exist or is not readable!", 1527613092);
        }

        try {
            $content = file_get_contents($path);
            $object = json_decode($content, true);
        } catch (Error $e) {
            throw new \RuntimeException("Invalid JSON string! Could not parse file '$path'.", 1527763163);
        } finally {
            return $object;
        }
    }

    /**
     * Resolve the global configuration.
     *
     * @return string The global configuration as array
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    protected static function resolveGlobalConfiguration(): array
    {
        try {
            $path = self::resolveGlobalConfigurationPath();
            $config = self::readJsonFile($path);
        } catch (\Exception $e) {
            return [];
        }

        return $config;
    }

    /**
     * Resolve the global configuration file path.
     *
     * @return string The path to the global config.json file
     * @throws RuntimeException
     */
    protected static function resolveGlobalConfigurationPath(): string
    {
        $globalConfigurationPath = \getenv('COMPOSER_HOME');

        if ($globalConfigurationPath !== false) {
            return $globalConfigurationPath . \DIRECTORY_SEPARATOR . 'config.json';
        }

        if (\PHP_OS_FAMILY === 'Windows') {
            $currentUsername = \getenv('USERNAME');

            if ($currentUsername === false) {
                throw new \RuntimeException('Could not determine current username!', 1568044616707);
            }

            return "C:\\Users\\$currentUsername\\AppData\\Roaming\\Composer\\config.json";
        }

        $currentUsername = \posix_getpwuid(\posix_geteuid())['name'];

        if (\PHP_OS_FAMILY === 'Darwin') {
            return "/Users/$currentUsername/.composer/config.json";
        }

        $xdgConfigHome = \getenv('XDG_CONFIG_HOME');
        if ($xdgConfigHome !== false) {
            return "$xdgConfigHome/composer/config.json";
        }

        return "/home/$currentUsername/.composer/config.json";
    }
}
