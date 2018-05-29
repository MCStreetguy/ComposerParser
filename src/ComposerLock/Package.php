<?php

namespace MCStreetguy\ComposerLock;

class Package
{
    protected $name;

    protected $version;

    protected $type;

    protected $authors;

    protected $description;

    protected $homepage;

    protected $keywords;

    protected $time;

    protected $extra;

    /**
     * @var Source
     */
    protected $source;

    protected $require;

    protected $requireDev;

    protected $license;

    public function __construct(array $config)
    {
        $this->name = (array_key_exists('name', $config) ? $config['name'] : '');
        $this->version = (array_key_exists('version', $config) ? $config['version'] : '');
        $this->type = (array_key_exists('type', $config) ? $config['type'] : '');
        $this->authors = (array_key_exists('authors', $config) ? $config['authors'] : []);
        $this->description = (array_key_exists('description', $config) ? $config['description'] : '');
        $this->homepage = (array_key_exists('homepage', $config) ? $config['homepage'] : '');
        $this->keywords = (array_key_exists('keywords', $config) ? $config['keywords'] : []);
        $this->time = (array_key_exists('time', $config) ? $config['time'] : '');
        $this->extra = (array_key_exists('extra', $config) ? $config['extra'] : []);

        $this->source = (array_key_exists('source', $config) ? new Source($config['source']) : new Source());
        $this->dist = (array_key_exists('dist', $config) ? new Dist($config['dist']) : new Dist());

        $this->require = (array_key_exists('require', $config) ? $config['require'] : []);
        $this->requireDev = (array_key_exists('require-dev', $config) ? $config['require-dev'] : []);

        $this->license = (array_key_exists('license', $config) ? $config['license'] : ['']);
        $this->license = (is_array($this->license) ? $this->license[0] : $this->license);
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getVersion() : string
    {
        return $this->version;
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function getAuthors() : array
    {
        return $this->authors;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function getHomepage() : string
    {
        return $this->homepage;
    }

    public function getKeywords() : array
    {
        return $this->keywords;
    }

    public function getTime() : string
    {
        return $this->time;
    }

    public function getExtra() : array
    {
        return $this->extra;
    }

    public function getSource() : Source
    {
        return $this->source;
    }

    public function getDist() : Dist
    {
        return $this->dist;
    }

    public function getRequire() : array
    {
        return $this->require;
    }

    public function getRequireDev() : array
    {
        return $this->requireDev;
    }

    public function getLicense() : string
    {
        return $this->license;
    }
}
