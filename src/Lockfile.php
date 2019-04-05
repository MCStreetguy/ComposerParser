<?php

namespace MCStreetguy\ComposerParser;

use MCStreetguy\ComposerParser\Lockfile\Package;
use MCStreetguy\ComposerParser\Service\PackageMap;
use MCStreetguy\ComposerParser\Service\AbstractClass;

/**
 * This class represents the data of an composer lockfile the oop way.
 *
 * @see https://github.com/composer/composer/blob/master/composer.lock
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 */
class Lockfile extends AbstractClass
{
    /**
     * @var string
     */
    protected $readme;

    /**
     * @var string
     */
    protected $contentHash;

    /**
     * @var PackageMap
     */
    protected $packages;

    /**
     * @var PackageMap
     */
    protected $packagesDev;

    /**
     * @var array
     */
    protected $aliases;

    /**
     * @var string
     */
    protected $minimumStability;

    /**
     * @var array
     */
    protected $stabilityFlags;

    /**
     * @var bool
     */
    protected $preferStable;

    /**
     * @var bool
     */
    protected $preferLowest;

    /**
     * @var PackageMap
     */
    protected $platform;

    /**
     * @var PackageMap
     */
    protected $platformDev;

    /**
     * @var PackageMap
     */
    protected $platformOverrides;

    /**
     * Parses the given data and constructs a new instance from it.
     *
     * @param array $data The composer lockfile data
     */
    public function __construct(array $data = [])
    {
        // String data
        $this->readme = (array_key_exists('_readme', $data) ? $data['_readme'] : '');
        $this->contentHash = (array_key_exists('content-hash', $data) ? $data['content-hash'] : '');
        $this->minimumStability = (array_key_exists('minimum-stability', $data) ? $data['minimum-stability'] : '');

        // Boolean data
        $this->preferStable = (array_key_exists('prefer-stable', $data) && $data['prefer-stable']);
        $this->preferLowest = (array_key_exists('prefer-lowest', $data) && $data['prefer-lowest']);

        // Array data
        $this->aliases = (array_key_exists('aliases', $data) ? $data['aliases'] : []);
        $this->stabilityFlags = (array_key_exists('stability-flags', $data) ? $data['stability-flags'] : []);

        // Mapped data
        $this->platform = (array_key_exists('platform', $data) ? new PackageMap($data['platform']) : new PackageMap);
        $this->platformDev = (array_key_exists('platform-dev', $data) ? new PackageMap($data['platform-dev']) : new PackageMap());
        $this->platformOverride = (array_key_exists('platform-override', $data) ? new PackageMap($data['platform-override']) : new PackageMap());
        $this->packages = (array_key_exists('packages', $data) ? new PackageMap($data['packages']) : new PackageMap());
        $this->packagesDev = (array_key_exists('packages-dev', $data) ? new PackageMap($data['packages-dev']) : new PackageMap());
    }

    /**
     * Get the value of readme
     *
     * @return  string
     */
    public function getReadme()
    {
        return $this->readme;
    }

    /**
     * Get the value of contentHash
     *
     * @return  string
     */
    public function getContentHash()
    {
        return $this->contentHash;
    }

    /**
     * Get the value of packages
     *
     * @return  PackageMap
     */
    public function getPackages()
    {
        return $this->packages;
    }

    /**
     * Get the value of packagesDev
     *
     * @return  PackageMap
     */
    public function getPackagesDev()
    {
        return $this->packagesDev;
    }

    /**
     * Get the value of aliases
     *
     * @return  array
     */
    public function getAliases()
    {
        return $this->aliases;
    }

    /**
     * Get the value of minimumStability
     *
     * @return  string
     */
    public function getMinimumStability()
    {
        return $this->minimumStability;
    }

    /**
     * Get the value of stabilityFlags
     *
     * @return  array
     */
    public function getStabilityFlags()
    {
        return $this->stabilityFlags;
    }

    /**
     * Get the value of preferStable
     *
     * @return  bool
     */
    public function getPreferStable()
    {
        return $this->preferStable;
    }

    /**
     * Get the value of preferLowest
     *
     * @return  bool
     */
    public function getPreferLowest()
    {
        return $this->preferLowest;
    }

    /**
     * Get the value of platform
     *
     * @return  PackageMap
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * Get the value of platformDev
     *
     * @return  PackageMap
     */
    public function getPlatformDev()
    {
        return $this->platformDev;
    }

    /**
     * Get the value of platformOverrides
     *
     * @return  PackageMap
     */
    public function getPlatformOverrides()
    {
        return $this->platformOverrides;
    }
}
