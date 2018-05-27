<?php

namespace MCStreetguy;

use MCStreetguy\ComposerLockParser\Package;

class ComposerLockParser
{
    /**
     * The lockfile contents.
     * @var array
     */
    protected $lock;

    public function __construct()
    {
        $this->lock = [];
    }

    public function parse(string $path)
    {
        if (!\is_file($path) || !\is_readable($path) || !preg_match('/composer\.lock$/', $path)) {
            throw new InvalidArgumentException("Could not retrieve lockfile at path '$path'!", 1527460933);
        }

        $contents = file_get_contents($path);
        $this->lock = json_decode($contents);
    }

    public function getPackages() : array
    {
        if (empty($this->lock) || !array_key_exists('packages', $this->lock)) {
            return [];
        }

        $list = [];
        foreach ($this->lock['packages'] as $package) {
            $list[] = new Package($package);
        }

        return $list;
    }

    public function getDevPackages() : array
    {
        if (empty($this->lock) || !array_key_exists('packages', $this->lock)) {
            return [];
        }

        $list = [];
        foreach ($this->lock['dev-packages'] as $package) {
            $list[] = new Package($package);
        }

        return $list;
    }
}
