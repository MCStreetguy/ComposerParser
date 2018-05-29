<?php

namespace MCStreetguy;

use MCStreetguy\ComposerLockParser\Package;

class ComposerLock
{
    /**
     * The lockfile contents.
     * @var array
     */
    protected $lock;

    public function __construct()
    {
        $this->lock = [];

        if (!\is_file($path) || !\is_readable($path)) {
        }

        if (!preg_match('/composer\.lock$/', $path)) {
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
        if (empty($this->lock) || !array_key_exists('packages-dev', $this->lock)) {
            return [];
        }

        $list = [];
        foreach ($this->lock['packages-dev'] as $package) {
            $list[] = new Package($package);
        }

        return $list;
    }
}
