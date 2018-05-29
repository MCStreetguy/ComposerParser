<?php

namespace MCStreetguy;

use MCStreetguy\ComposerJson\Author;
use MCStreetguy\ComposerJson\Support;
use MCStreetguy\ComposerJson\Archive;
use MCStreetguy\ComposerJson\Autoload;
use MCStreetguy\ComposerJson\Config;
use MCStreetguy\ComposerJson\Repository;
use MCStreetguy\ComposerJson\Scripts;

use MCStreetguy\ComposerJson\Service\PackageMap;

/**
 * This class represents the data of an composer.json file the oop way.
 *
 * @see https://getcomposer.org/doc/04-schema.md
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 */
class ComposerJson
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $keywords;

    /**
     * @var string
     */
    protected $homepage;

    /**
     * @var string
     */
    protected $readme;

    /**
     * @var string
     */
    protected $time;

    /**
     * @var array
     */
    protected $license;

    /**
     * @var Author[]
     */
    protected $authors;

    /**
     * @var Support
     */
    protected $support;

    /**
     * @var PackageMap
     */
    protected $require;

    /**
     * @var PackageMap
     */
    protected $requireDev;

    /**
     * @var PackageMap
     */
    protected $conflict;

    /**
     * @var PackageMap
     */
    protected $replace;

    /**
     * @var PackageMap
     */
    protected $provide;

    /**
     * @var PackageMap
     */
    protected $suggest;

    /**
     * @var Autoload
     */
    protected $autoload;

    /**
     * @var Autoload
     */
    protected $autoloadDev;

    /**
     * @var array
     */
    protected $includePath;

    /**
     * @var string
     */
    protected $targetDir;

    /**
     * @var string
     */
    protected $minimumStability;

    /**
     * @var bool
     */
    protected $preferStable;

    /**
     * @var Repository[]
     */
    protected $repositories;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Scripts
     */
    protected $scripts;

    /**
     * @var array
     */
    protected $extra;

    /**
     * @var array
     */
    protected $bin;

    /**
     * @var Archive
     */
    protected $archive;

    /**
     * @var bool
     */
    protected $abandoned;

    /**
     * @var array
     */
    protected $nonFeatureBranches;

    /**
     * Parses the given data and constructs a new instance from it.
     *
     * @param array $data The data of the composer.json file
     */
    public function __construct(array $data = [])
    {
        // String data
        $this->name =               (array_key_exists('name', $data) ? $data['name'] : '');
        $this->description =        (array_key_exists('description', $data) ? $data['description'] : '');
        $this->version =            (array_key_exists('version', $data) ? $data['version'] : '');
        $this->type =               (array_key_exists('type', $data) ? $data['type'] : '');
        $this->homepage =           (array_key_exists('homepage', $data) ? $data['homepage'] : '');
        $this->readme =             (array_key_exists('readme', $data) ? $data['readme'] : '');
        $this->time =               (array_key_exists('time', $data) ? $data['time'] : '');
        $this->targetDir =          (array_key_exists('target-dir', $data) ? $data['target-dir'] : '');
        $this->minimumStability =   (array_key_exists('minimum-stability', $data) ? $data['minimum-stability'] : '');

        // Boolean data
        $this->preferStable =       (array_key_exists('prefer-stable', $data) && $data['prefer-stable']);
        $this->abandoned =          (array_key_exists('abandoned', $data) && $data['abandoned']);

        // Array data
        $this->keywords =           (array_key_exists('keywords', $data) ? $data['keywords'] : []);
        $this->includePath =        (array_key_exists('include-path', $data) ? $data['include-path'] : []);
        $this->extra =              (array_key_exists('extra', $data) ? $data['extra'] : []);
        $this->bin =                (array_key_exists('bin', $data) ? $data['bin'] : []);
        $this->nonFeatureBranches = (array_key_exists('non-feature-branches', $data) ? $data['non-feature-branches'] : []);

        // Recursive data
        $this->support =            (array_key_exists('support', $data) ? new Support($data['support']) : new Support());
        $this->autoload =           (array_key_exists('autoload', $data) ? new Autoload($data['autoload']) : new Autoload());
        $this->autoloadDev =        (array_key_exists('autoload-dev', $data) ? new Autoload($data['autoload-dev']) : new Autoload());
        $this->config =             (array_key_exists('config', $data) ? new Config($data['config']) : new Config());
        $this->scripts =            (array_key_exists('scripts', $data) ? new Scripts($data['scripts']) : new Scripts());
        $this->archive =            (array_key_exists('archive', $data) ? new Archive($data['archive']) : new Archive());

        // Mapped data
        $this->require =            (array_key_exists('require', $data) ? new PackageMap($data['require']) : new PackageMap());
        $this->requireDev =         (array_key_exists('require-dev', $data) ? new PackageMap($data['require-dev']) : new PackageMap());
        $this->conflict =           (array_key_exists('conflict', $data) ? new PackageMap($data['conflict']) : new PackageMap());
        $this->replace =            (array_key_exists('replace', $data) ? new PackageMap($data['replace']) : new PackageMap());
        $this->provide =            (array_key_exists('provide', $data) ? new PackageMap($data['provide']) : new PackageMap());
        $this->suggest =            (array_key_exists('suggest', $data) ? new PackageMap($data['suggest']) : new PackageMap());

        // Special cases
        if (array_key_exists('license', $data)) {
            $license = $data['license'];

            if (is_string($license)) {
                $license = [$license];
            }

            $this->license = $license;
        } else {
            $this->license = [];
        }

        $this->authors = [];
        if (array_key_exists('authors', $data)) {
            foreach ($data['authors'] as $author) {
                $this->authors[] = new Author($author);
            }
        }

        $this->repositories = [];
        if (array_key_exists('repositories', $data)) {
            foreach ($data['repositories'] as $repository) {
                $this->repositories[] = new Repository($repository);
            }
        }
    }

    /**
     * Get the value of name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of description
     *
     * @return  string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the value of version
     *
     * @return  string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Get the value of type
     *
     * @return  string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the value of keywords
     *
     * @return  array
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Get the value of homepage
     *
     * @return  string
     */
    public function getHomepage()
    {
        return $this->homepage;
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
     * Get the value of time
     *
     * @return  string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Get the value of license
     *
     * @return  array
     */
    public function getLicense()
    {
        return $this->license;
    }

    /**
     * Get the value of authors
     *
     * @return  Author[]
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Get the value of support
     *
     * @return  Support
     */
    public function getSupport()
    {
        return $this->support;
    }

    /**
     * Get the value of require
     *
     * @return  PackageMap
     */
    public function getRequire()
    {
        return $this->require;
    }

    /**
     * Get the value of requireDev
     *
     * @return  PackageMap
     */
    public function getRequireDev()
    {
        return $this->requireDev;
    }

    /**
     * Get the value of conflict
     *
     * @return  PackageMap
     */
    public function getConflict()
    {
        return $this->conflict;
    }

    /**
     * Get the value of replace
     *
     * @return  PackageMap
     */
    public function getReplace()
    {
        return $this->replace;
    }

    /**
     * Get the value of provide
     *
     * @return  PackageMap
     */
    public function getProvide()
    {
        return $this->provide;
    }

    /**
     * Get the value of suggest
     *
     * @return  PackageMap
     */
    public function getSuggest()
    {
        return $this->suggest;
    }

    /**
     * Get the value of autoload
     *
     * @return  Autoload
     */
    public function getAutoload()
    {
        return $this->autoload;
    }

    /**
     * Get the value of autoloadDev
     *
     * @return  Autoload
     */
    public function getAutoloadDev()
    {
        return $this->autoloadDev;
    }

    /**
     * Get the value of includePath
     *
     * @return  array
     */
    public function getIncludePath()
    {
        return $this->includePath;
    }

    /**
     * Get the value of targetDir
     *
     * @return  string
     */
    public function getTargetDir()
    {
        return $this->targetDir;
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
     * Get the value of preferStable
     *
     * @return  bool
     */
    public function getPreferStable()
    {
        return $this->preferStable;
    }

    /**
     * Get the value of repositories
     *
     * @return  Repository[]
     */
    public function getRepositories()
    {
        return $this->repositories;
    }

    /**
     * Get the value of config
     *
     * @return  Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Get the value of scripts
     *
     * @return  Scripts
     */
    public function getScripts()
    {
        return $this->scripts;
    }

    /**
     * Get the value of extra
     *
     * @return  array
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * Get the value of bin
     *
     * @return  array
     */
    public function getBin()
    {
        return $this->bin;
    }

    /**
     * Get the value of archive
     *
     * @return  Archive
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * Get the value of abandoned
     *
     * @return  bool
     */
    public function getAbandoned()
    {
        return $this->abandoned;
    }

    /**
     * Get the value of nonFeatureBranches
     *
     * @return  array
     */
    public function getNonFeatureBranches()
    {
        return $this->nonFeatureBranches;
    }
}
