<?php

namespace MCStreetguy\ComposerParser\Json;

use MCStreetguy\ComposerParser\Service\PropertyHelper;
use MCStreetguy\ComposerParser\Service\AbstractClass;

/**
 * This class represents the "config" section in the composer.json schema.
 *
 * @see https://getcomposer.org/doc/06-config.md
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 *
 * @SuppressWarnings("complexity")
 */
class Config extends AbstractClass
{
    // TODO: Property documentations
    protected $processTimeout;
    protected $useIncludePath;
    protected $preferredInstall;
    protected $storeAuths;
    protected $githubProtocols;
    protected $githubOauth;
    protected $gitlabOauth;
    protected $gitlabToken;
    protected $disableTls;
    protected $secureHttp;
    protected $bitbucketOauth;
    protected $cafile;
    protected $capath;
    protected $httpBasic;
    protected $platform;
    protected $vendorDir;
    protected $binDir;
    protected $dataDir;
    protected $cacheDir;
    protected $cacheFilesDir;
    protected $cacheRepoDir;
    protected $cacheVcsDir;
    protected $cacheFilesTtl;
    protected $cacheFilesMaxSize;
    protected $binCompat;
    protected $prependAutoloader;
    protected $autoloaderSuffix;
    protected $optimizeAutoloader;
    protected $sortPackages;
    protected $classmapAuthoritative;
    protected $apcuAutoloader;
    protected $githubDomains;
    protected $githubExposeHostname;
    protected $gitlabDomains;
    protected $notifyOnInstall;
    protected $discardChanges;
    protected $archiveFormat;
    protected $archiveDir;
    protected $htaccessProtect;

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
     * Get the value of processTimeout
     */
    public function getProcessTimeout()
    {
        return $this->processTimeout;
    }

    /**
     * Get the value of useIncludePath
     */
    public function getUseIncludePath()
    {
        return $this->useIncludePath;
    }

    /**
     * Get the value of preferredInstall
     */
    public function getPreferredInstall()
    {
        return $this->preferredInstall;
    }

    /**
     * Get the value of storeAuths
     */
    public function getStoreAuths()
    {
        return $this->storeAuths;
    }

    /**
     * Get the value of githubProtocols
     */
    public function getGithubProtocols()
    {
        return $this->githubProtocols;
    }

    /**
     * Get the value of githubOauth
     */
    public function getGithubOauth()
    {
        return $this->githubOauth;
    }

    /**
     * Get the value of gitlabOauth
     */
    public function getGitlabOauth()
    {
        return $this->gitlabOauth;
    }

    /**
     * Get the value of gitlabToken
     */
    public function getGitlabToken()
    {
        return $this->gitlabToken;
    }

    /**
     * Get the value of disableTls
     */
    public function getDisableTls()
    {
        return $this->disableTls;
    }

    /**
     * Get the value of secureHttp
     */
    public function getSecureHttp()
    {
        return $this->secureHttp;
    }

    /**
     * Get the value of bitbucketOauth
     */
    public function getBitbucketOauth()
    {
        return $this->bitbucketOauth;
    }

    /**
     * Get the value of cafile
     */
    public function getCafile()
    {
        return $this->cafile;
    }

    /**
     * Get the value of capath
     */
    public function getCapath()
    {
        return $this->capath;
    }

    /**
     * Get the value of httpBasic
     */
    public function getHttpBasic()
    {
        return $this->httpBasic;
    }

    /**
     * Get the value of platform
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * Get the value of vendorDir
     */
    public function getVendorDir()
    {
        return $this->vendorDir;
    }

    /**
     * Get the value of binDir
     */
    public function getBinDir()
    {
        return $this->binDir;
    }

    /**
     * Get the value of dataDir
     */
    public function getDataDir()
    {
        return $this->dataDir;
    }

    /**
     * Get the value of cacheDir
     */
    public function getCacheDir()
    {
        return $this->cacheDir;
    }

    /**
     * Get the value of cacheFilesDir
     */
    public function getCacheFilesDir()
    {
        return $this->cacheFilesDir;
    }

    /**
     * Get the value of cacheRepoDir
     */
    public function getCacheRepoDir()
    {
        return $this->cacheRepoDir;
    }

    /**
     * Get the value of cacheVcsDir
     */
    public function getCacheVcsDir()
    {
        return $this->cacheVcsDir;
    }

    /**
     * Get the value of cacheFilesTtl
     */
    public function getCacheFilesTtl()
    {
        return $this->cacheFilesTtl;
    }

    /**
     * Get the value of cacheFilesMaxSize
     */
    public function getCacheFilesMaxSize()
    {
        return $this->cacheFilesMaxSize;
    }

    /**
     * Get the value of binCompat
     */
    public function getBinCompat()
    {
        return $this->binCompat;
    }

    /**
     * Get the value of prependAutoloader
     */
    public function getPrependAutoloader()
    {
        return $this->prependAutoloader;
    }

    /**
     * Get the value of autoloaderSuffix
     */
    public function getAutoloaderSuffix()
    {
        return $this->autoloaderSuffix;
    }

    /**
     * Get the value of optimizeAutoloader
     */
    public function getOptimizeAutoloader()
    {
        return $this->optimizeAutoloader;
    }

    /**
     * Get the value of sortPackages
     */
    public function getSortPackages()
    {
        return $this->sortPackages;
    }

    /**
     * Get the value of classmapAuthoritative
     */
    public function getClassmapAuthoritative()
    {
        return $this->classmapAuthoritative;
    }

    /**
     * Get the value of apcuAutoloader
     */
    public function getApcuAutoloader()
    {
        return $this->apcuAutoloader;
    }

    /**
     * Get the value of githubDomains
     */
    public function getGithubDomains()
    {
        return $this->githubDomains;
    }

    /**
     * Get the value of githubExposeHostname
     */
    public function getGithubExposeHostname()
    {
        return $this->githubExposeHostname;
    }

    /**
     * Get the value of gitlabDomains
     */
    public function getGitlabDomains()
    {
        return $this->gitlabDomains;
    }

    /**
     * Get the value of notifyOnInstall
     */
    public function getNotifyOnInstall()
    {
        return $this->notifyOnInstall;
    }

    /**
     * Get the value of discardChanges
     */
    public function getDiscardChanges()
    {
        return $this->discardChanges;
    }

    /**
     * Get the value of archiveFormat
     */
    public function getArchiveFormat()
    {
        return $this->archiveFormat;
    }

    /**
     * Get the value of archiveDir
     */
    public function getArchiveDir()
    {
        return $this->archiveDir;
    }

    /**
     * Get the value of htaccessProtect
     */
    public function getHtaccessProtect()
    {
        return $this->htaccessProtect;
    }
}
