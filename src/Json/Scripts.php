<?php

namespace MCStreetguy\ComposerParser\Json;

use MCStreetguy\ComposerParser\Service\PropertyHelper;
use MCStreetguy\ComposerParser\Service\AbstractClass;

/**
 * This class represents the "config" section in the composer.json schema.
 *
 * @see https://getcomposer.org/doc/articles/scripts.md
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 */
class Scripts extends AbstractClass
{
    /**
     * @var array
     */
    protected $preInstallCmd;

    /**
     * @var array
     */
    protected $postInstallCmd;

    /**
     * @var array
     */
    protected $preUpdateCmd;

    /**
     * @var array
     */
    protected $postUpdateCmd;

    /**
     * @var array
     */
    protected $postStatusCmd;

    /**
     * @var array
     */
    protected $preArchiveCmd;

    /**
     * @var array
     */
    protected $postArchiveCmd;
    
    /**
     * @var array
     */
    protected $preAutloadDump;
    
    /**
     * @var array
     */
    protected $postAutoloadDump;

    /**
     * @var array
     */
    protected $postRootPackageInstall;
    
    /**
     * @var array
     */
    protected $postCreateProjectCmd;
    
    /**
     * @var array
     */
    protected $preDependenciesSolving;
    
    /**
     * @var array
     */
    protected $postDependenciesSolving;
    
    /**
     * @var array
     */
    protected $prePackageInstall;

    /**
     * @var array
     */
    protected $postPackageInstall;
    
    /**
     * @var array
     */
    protected $prePackageUpdate;
    
    /**
     * @var array
     */
    protected $postPackageUpdate;
    
    /**
     * @var array
     */
    protected $prePackageUninstall;
    
    /**
     * @var array
     */
    protected $postPackageUninstall;

    /**
     * @var array
     */
    protected $init;
    
    /**
     * @var array
     */
    protected $command;
    
    /**
     * @var array
     */
    protected $preFileDownload;

    /**
     * @var array
     */
    protected $preCommandRun;

    /**
     * Parses the given data and constructs a new instance from it.
     *
     * @param array $data The composer.json partial data
     */
    public function __construct(array $data = [])
    {
        foreach ($this as $property => $value) {
            $key = PropertyHelper::convertPropertyToJsonKey($property);

            if (array_key_exists($key, $data)) {
                $this->$property = $data[$key];
            }
        }
    }

    /**
     * Get the value of preInstallCmd
     *
     * @return  array
     */
    public function getPreInstallCmd(): array
    {
        return $this->preInstallCmd;
    }

    /**
     * Get the value of postInstallCmd
     *
     * @return  array
     */
    public function getPostInstallCmd(): array
    {
        return $this->postInstallCmd;
    }

    /**
     * Get the value of preUpdateCmd
     *
     * @return  array
     */
    public function getPreUpdateCmd(): array
    {
        return $this->preUpdateCmd;
    }

    /**
     * Get the value of postUpdateCmd
     *
     * @return  array
     */
    public function getPostUpdateCmd(): array
    {
        return $this->postUpdateCmd;
    }

    /**
     * Get the value of postStatusCmd
     *
     * @return  array
     */
    public function getPostStatusCmd(): array
    {
        return $this->postStatusCmd;
    }

    /**
     * Get the value of preArchiveCmd
     *
     * @return  array
     */
    public function getPreArchiveCmd(): array
    {
        return $this->preArchiveCmd;
    }

    /**
     * Get the value of postArchiveCmd
     *
     * @return  array
     */
    public function getPostArchiveCmd(): array
    {
        return $this->postArchiveCmd;
    }

    /**
     * Get the value of preAutloadDump
     *
     * @return  array
     */
    public function getPreAutloadDump(): array
    {
        return $this->preAutloadDump;
    }

    /**
     * Get the value of postAutoloadDump
     *
     * @return  array
     */
    public function getPostAutoloadDump(): array
    {
        return $this->postAutoloadDump;
    }

    /**
     * Get the value of postRootPackageInstall
     *
     * @return  array
     */
    public function getPostRootPackageInstall(): array
    {
        return $this->postRootPackageInstall;
    }

    /**
     * Get the value of postCreateProjectCmd
     *
     * @return  array
     */
    public function getPostCreateProjectCmd(): array
    {
        return $this->postCreateProjectCmd;
    }

    /**
     * Get the value of preDependenciesSolving
     *
     * @return  array
     */
    public function getPreDependenciesSolving(): array
    {
        return $this->preDependenciesSolving;
    }

    /**
     * Get the value of postDependenciesSolving
     *
     * @return  array
     */
    public function getPostDependenciesSolving(): array
    {
        return $this->postDependenciesSolving;
    }

    /**
     * Get the value of prePackageInstall
     *
     * @return  array
     */
    public function getPrePackageInstall(): array
    {
        return $this->prePackageInstall;
    }

    /**
     * Get the value of postPackageInstall
     *
     * @return  array
     */
    public function getPostPackageInstall(): array
    {
        return $this->postPackageInstall;
    }

    /**
     * Get the value of prePackageUpdate
     *
     * @return  array
     */
    public function getPrePackageUpdate(): array
    {
        return $this->prePackageUpdate;
    }

    /**
     * Get the value of postPackageUpdate
     *
     * @return  array
     */
    public function getPostPackageUpdate(): array
    {
        return $this->postPackageUpdate;
    }

    /**
     * Get the value of prePackageUninstall
     *
     * @return  array
     */
    public function getPrePackageUninstall(): array
    {
        return $this->prePackageUninstall;
    }

    /**
     * Get the value of postPackageUninstall
     *
     * @return  array
     */
    public function getPostPackageUninstall(): array
    {
        return $this->postPackageUninstall;
    }

    /**
     * Get the value of init
     *
     * @return  array
     */
    public function getInit(): array
    {
        return $this->init;
    }

    /**
     * Get the value of command
     *
     * @return  array
     */
    public function getCommand(): array
    {
        return $this->command;
    }

    /**
     * Get the value of preFileDownload
     *
     * @return  array
     */
    public function getPreFileDownload(): array
    {
        return $this->preFileDownload;
    }

    /**
     * Get the value of preCommandRun
     *
     * @return  array
     */
    public function getPreCommandRun(): array
    {
        return $this->preCommandRun;
    }
}
