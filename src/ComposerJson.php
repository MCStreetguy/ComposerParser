<?php

namespace MCStreetguy\ComposerParser;

use MCStreetguy\ComposerParser\Json\Archive;
use MCStreetguy\ComposerParser\Json\Author;
use MCStreetguy\ComposerParser\Json\Autoload;
use MCStreetguy\ComposerParser\Json\Config;
use MCStreetguy\ComposerParser\Json\Repository;
use MCStreetguy\ComposerParser\Json\Scripts;
use MCStreetguy\ComposerParser\Json\Support;
use MCStreetguy\ComposerParser\Service\AbstractClass;
use MCStreetguy\ComposerParser\Service\PackageMap;

/**
 * This class represents the data of an composer.json file the oop way.
 *
 * @see https://getcomposer.org/doc/04-schema.md
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 *
 * @SuppressWarnings("complexity")
 */
class ComposerJson extends AbstractClass
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
     * @var array
     */
    protected $_data;

    /**
     * Parses the given data and constructs a new instance from it.
     *
     * @param array $data The data of the composer.json file
     *
     * @SuppressWarnings("complexity")
     */
    public function __construct(array $data = [])
    {
        $this->_data = $data;

        // String data
        $this->name = (array_key_exists('name', $data) ? $data['name'] : '');
        $this->description = (array_key_exists('description', $data) ? $data['description'] : '');
        $this->version = (array_key_exists('version', $data) ? $data['version'] : '');
        $this->type = (array_key_exists('type', $data) ? $data['type'] : '');
        $this->homepage = (array_key_exists('homepage', $data) ? $data['homepage'] : '');
        $this->readme = (array_key_exists('readme', $data) ? $data['readme'] : '');
        $this->time = (array_key_exists('time', $data) ? $data['time'] : '');
        $this->targetDir = (array_key_exists('target-dir', $data) ? $data['target-dir'] : '');
        $this->minimumStability = (array_key_exists('minimum-stability', $data) ? $data['minimum-stability'] : '');

        // Boolean data
        $this->preferStable = (array_key_exists('prefer-stable', $data) && $data['prefer-stable']);
        $this->abandoned = (array_key_exists('abandoned', $data) && $data['abandoned']);

        // Array data
        $this->keywords = (array_key_exists('keywords', $data) ? $data['keywords'] : []);
        $this->includePath = (array_key_exists('include-path', $data) ? $data['include-path'] : []);
        $this->extra = (array_key_exists('extra', $data) ? $data['extra'] : []);
        $this->bin = (array_key_exists('bin', $data) ? $data['bin'] : []);
        $this->nonFeatureBranches = (array_key_exists('non-feature-branches', $data) ? $data['non-feature-branches'] : []);

        // Recursive data
        $this->support = (array_key_exists('support', $data) ? new Support($data['support']) : new Support());
        $this->autoload = (array_key_exists('autoload', $data) ? new Autoload($data['autoload']) : new Autoload());
        $this->autoloadDev = (array_key_exists('autoload-dev', $data) ? new Autoload($data['autoload-dev']) : new Autoload());
        $this->config = (array_key_exists('config', $data) ? new Config($data['config']) : new Config());
        $this->scripts = (array_key_exists('scripts', $data) ? new Scripts($data['scripts']) : new Scripts());
        $this->archive = (array_key_exists('archive', $data) ? new Archive($data['archive']) : new Archive());

        // Mapped data
        $this->require = (array_key_exists('require', $data) ? new PackageMap($data['require']) : new PackageMap());
        $this->requireDev = (array_key_exists('require-dev', $data) ? new PackageMap($data['require-dev']) : new PackageMap());
        $this->conflict = (array_key_exists('conflict', $data) ? new PackageMap($data['conflict']) : new PackageMap());
        $this->replace = (array_key_exists('replace', $data) ? new PackageMap($data['replace']) : new PackageMap());
        $this->provide = (array_key_exists('provide', $data) ? new PackageMap($data['provide']) : new PackageMap());
        $this->suggest = (array_key_exists('suggest', $data) ? new PackageMap($data['suggest']) : new PackageMap());

        // Special cases
        $this->license = [];
        if (array_key_exists('license', $data)) {
            $license = $data['license'];

            if (is_string($license)) {
                $license = [$license];
            }

            $this->license = $license;
        }

        $this->authors = [];
        if (array_key_exists('authors', $data)) {
            foreach ($data['authors'] as $author) {
                $this->authors[] = new Author($author);
            }
        }

        $this->repositories = [];
        $packagistOrgDisabled = false;

        if (array_key_exists('repositories', $data)) {
            foreach ($data['repositories'] as $key => $repository) {
                if (array_key_exists('packagist.org', $repository) && $repository['packagist.org'] === false) {
                    $packagistOrgDisabled = true;
                    continue;
                }

                $this->repositories[$key] = new Repository($repository);
            }
        }

        if ($packagistOrgDisabled === false && !isset($this->repositories['packagist.org'])) {
            $this->repositories['packagist.org'] = new Repository([
                'type' => 'composer',
                'url' => 'https?://repo.packagist.org',
                'allow_ssl_downgrade' => true,
            ]);
        }
    }

    /**
     * Get the value of name
     *
     * @return  string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the value of description
     *
     * @return  string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Get the value of version
     *
     * @return  string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Get the value of type
     *
     * @return  string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get the value of keywords
     *
     * @return  array
     */
    public function getKeywords(): array
    {
        return $this->keywords;
    }

    /**
     * Get the value of homepage
     *
     * @return  string
     */
    public function getHomepage(): string
    {
        return $this->homepage;
    }

    /**
     * Get the value of readme
     *
     * @return  string
     */
    public function getReadme(): string
    {
        return $this->readme;
    }

    /**
     * Get the value of time
     *
     * @return  string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * Get the value of license
     *
     * @return  array
     */
    public function getLicense(): array
    {
        return $this->license;
    }

    /**
     * Get the value of authors
     *
     * @return  Author[]
     */
    public function getAuthors(): Author
    {
        return $this->authors;
    }

    /**
     * Get the value of support
     *
     * @return  Support
     */
    public function getSupport(): Support
    {
        return $this->support;
    }

    /**
     * Get the value of require
     *
     * @return  PackageMap
     */
    public function getRequire(): PackageMap
    {
        return $this->require;
    }

    /**
     * Get the value of requireDev
     *
     * @return  PackageMap
     */
    public function getRequireDev(): PackageMap
    {
        return $this->requireDev;
    }

    /**
     * Get the value of conflict
     *
     * @return  PackageMap
     */
    public function getConflict(): PackageMap
    {
        return $this->conflict;
    }

    /**
     * Get the value of replace
     *
     * @return  PackageMap
     */
    public function getReplace(): PackageMap
    {
        return $this->replace;
    }

    /**
     * Get the value of provide
     *
     * @return  PackageMap
     */
    public function getProvide(): PackageMap
    {
        return $this->provide;
    }

    /**
     * Get the value of suggest
     *
     * @return  PackageMap
     */
    public function getSuggest(): PackageMap
    {
        return $this->suggest;
    }

    /**
     * Get the value of autoload
     *
     * @return  Autoload
     */
    public function getAutoload(): Autoload
    {
        return $this->autoload;
    }

    /**
     * Get the value of autoloadDev
     *
     * @return  Autoload
     */
    public function getAutoloadDev(): Autoload
    {
        return $this->autoloadDev;
    }

    /**
     * Get the value of includePath
     *
     * @return  array
     */
    public function getIncludePath(): array
    {
        return $this->includePath;
    }

    /**
     * Get the value of targetDir
     *
     * @return  string
     */
    public function getTargetDir(): string
    {
        return $this->targetDir;
    }

    /**
     * Get the value of minimumStability
     *
     * @return  string
     */
    public function getMinimumStability(): string
    {
        return $this->minimumStability;
    }

    /**
     * Get the value of preferStable
     *
     * @return  bool
     */
    public function isPreferringStable(): bool
    {
        return $this->preferStable;
    }

    /**
     * Get the value of repositories
     *
     * @return  Repository[]
     */
    public function getRepositories(): Repository
    {
        return $this->repositories;
    }

    /**
     * Get the value of config
     *
     * @return  Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * Get the value of scripts
     *
     * @return  Scripts
     */
    public function getScripts(): Scripts
    {
        return $this->scripts;
    }

    /**
     * Get the value of extra
     *
     * @return  array
     */
    public function getExtra(): array
    {
        return $this->extra;
    }

    /**
     * Get the value of bin
     *
     * @return  array
     */
    public function getBin(): array
    {
        return $this->bin;
    }

    /**
     * Get the value of archive
     *
     * @return  Archive
     */
    public function getArchive(): Archive
    {
        return $this->archive;
    }

    /**
     * Get the value of abandoned
     *
     * @return  bool
     */
    public function isAbandoned(): bool
    {
        return $this->abandoned;
    }

    /**
     * Get the value of nonFeatureBranches
     *
     * @return  array
     */
    public function getNonFeatureBranches(): array
    {
        return $this->nonFeatureBranches;
    }

    /**
     * Get the whole manifest file as array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->_data;
    }
}
