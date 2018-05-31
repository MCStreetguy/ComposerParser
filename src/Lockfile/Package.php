<?php

namespace MCStreetguy\ComposerParser\Lockfile;

use MCStreetguy\ComposerParser\Json\Autoload;
use MCStreetguy\ComposerParser\Json\Author;

use MCStreetguy\ComposerParser\Service\PackageMap;
use MCStreetguy\ComposerParser\Service\AbstractClass;

/**
 * This class represents an entry in the "packages" section in the composer.lock schema.
 *
 * @author Maximilian Schmidt <maximilianschmidt404@gmail.com>
 * @license MIT
 */
class Package extends AbstractClass
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var Source
     */
    protected $source;
    
    /**
     * @var Dist
     */
    protected $dist;

    /**
     * @var PackageMap
     */
    protected $require;

    /**
     * @var PackageMap
     */
    protected $requireDev;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $extra;

    /**
     * @var Autoload
     */
    protected $autoload;

    /**
     * @var string
     */
    protected $notificationUrl;

    /**
     * @var array
     */
    protected $license;

    /**
     * @var Author[]
     */
    protected $authors;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var array
     */
    protected $keywords;

    /**
     * @var string
     */
    protected $time;

    /**
     * Parses the given data and constructs a new instance from it.
     *
     * @param array $data The composer lockfile partial data
     */
    public function __construct(array $data = [])
    {
        // String data
        $this->name = (array_key_exists('name', $data) ? $data['name'] : '');
        $this->version = (array_key_exists('version', $data) ? $data['version'] : '');
        $this->type = (array_key_exists('type', $data) ? $data['type'] : '');
        $this->notificationUrl = (array_key_exists('notification-url', $data) ? $data['notification-url'] : '');
        $this->description = (array_key_exists('description', $data) ? $data['description'] : '');
        $this->time = (array_key_exists('time', $data) ? $data['time'] : '');

        // Array data
        $this->extra = (array_key_exists('extra', $data) ? $data['extra'] : []);
        $this->keywords = (array_key_exists('keywords', $data) ? $data['keywords'] : []);

        // Recursive data
        $this->source = (array_key_exists('source', $data) ? new Source($data['source']) : new Source());
        $this->dist = (array_key_exists('dist', $data) ? new Dist($data['dist']) : new Dist());

        // Mapped data
        $this->require = (array_key_exists('require', $data) ? new PackageMap($data['require']) : new PackageMap());
        $this->requireDev = (array_key_exists('require-dev', $data) ? new PackageMap($data['require-dev']) : new PackageMap());

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
    }
}
