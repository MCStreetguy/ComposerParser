<?php

namespace MCStreetguy;

use MCStreetguy\ComposerJson\Author;

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

    protected $support;

    protected $require;

    protected $requireDev;

    protected $conflict;

    protected $replace;

    protected $provide;

    protected $suggest;

    protected $autoload;

    protected $autoloadDev;

    protected $includePath;

    protected $targetDir;

    protected $minimumStability;

    protected $preferStable;

    protected $repositories;

    protected $config;

    protected $scripts;

    protected $extra;

    protected $bin;

    protected $archive;

    protected $abandoned;

    protected $nonFeatureBranches;

    /**
     * Parses the given data and constructs a new instance from it.
     *
     * @param array $data The data of the composer.json file
     */
    public function __construct(array $data)
    {
        $this->name = (array_key_exists('name', $data) ? $data['name'] : '');
        $this->description = (array_key_exists('description', $data) ? $data['description'] : '');
        $this->version = (array_key_exists('version', $data) ? $data['version'] : '');
        $this->type = (array_key_exists('type', $data) ? $data['type'] : '');
        $this->homepage = (array_key_exists('homepage', $data) ? $data['homepage'] : '');
        $this->readme = (array_key_exists('readme', $data) ? $data['readme'] : '');
        $this->time = (array_key_exists('time', $data) ? $data['time'] : '');

        $this->keywords = (array_key_exists('keywords', $data) ? $data['keywords'] : []);

        if (array_key_exists('license', $data)) {
            $license = $data['license'];

            if (is_string($license)) {
                $license = [$license];
            }

            $this->license = $license;
        } else {
            $this->license = [];
        }

        if (array_key_exists('authors', $data)) {
            $this->authors = [];

            foreach ($data['authors'] as $author) {
                $this->authors[] = new Author($author);
            }
        }
    }
}
