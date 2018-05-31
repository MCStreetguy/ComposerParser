<?php

namespace MCStreetguy\ComposerParser\Json;

use MCStreetguy\ComposerParser\Service\NamespaceMap;
use MCStreetguy\ComposerParser\Service\AbstractClass;

/**
 * This class represents the "autoload" section in the composer.json schema.
 *
 * @see https://getcomposer.org/doc/04-schema.md#autoload
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 */
class Autoload extends AbstractClass
{
    /**
     * @var NamespaceMap
     */
    protected $psr4;

    /**
     * @var NamespaceMap
     */
    protected $psr0;

    /**
     * @var array
     */
    protected $classmap;

    /**
     * @var array
     */
    protected $files;

    /**
     * @var array
     */
    protected $excludeFromClassmap;

    /**
     * Parses the given data and constructs a new instance from it.
     *
     * @param array $data The composer.json partial data
     */
    public function __construct(array $data = [])
    {
        $this->classmap = (array_key_exists('classmap', $data) ? $data['classmap'] : []);
        $this->files = (array_key_exists('files', $data) ? $data['files'] : []);
        $this->excludeFromClassmap = (array_key_exists('exclude-from-classmap', $data) ? $data['exclude-from-classmap'] : []);

        $this->psr0 = (array_key_exists('psr-0', $data) ? new NamespaceMap($data['psr-0']) : new NamespaceMap());
        $this->psr4 = (array_key_exists('psr-4', $data) ? new NamespaceMap($data['psr-4']) : new NamespaceMap());
    }

    /**
     * Gets the autoloaded PSR-4 namespace map.
     * @return NamespaceMap
     */
    public function getPsr4() : NamespaceMap
    {
        return $this->psr4;
    }

    /**
     * Gets the autoloaded PSR-0 namespace map.
     * @return NamespaceMap
     */
    public function getPsr0() : NamespaceMap
    {
        return $this->psr0;
    }

    /**
     * Gets the autoloaded classmap.
     * @return array
     */
    public function getClassmap() : array
    {
        return $this->classmap;
    }

    /**
     * Gets the autoloaded files.
     * @return array
     */
    public function getFiles() : array
    {
        return $this->files;
    }

    /**
     * Gets the excluded files from the classmap.
     * @return array
     */
    public function getExcludeFromClassmap() : array
    {
        return $this->excludeFromClassmap;
    }
}
