# Composer Parser

**A dependency-free parser library for composer.json and composer.lock files.**

- [Composer Parser](#composer-parser)
  - [Installation](#installation)
  - [Usage](#usage)
    - [Parsing](#parsing)
      - [Exception Handling](#exception-handling)
      - [Doing it the manual way](#doing-it-the-manual-way)
        - [Sub-components](#sub-components)
    - [Data Retrieval](#data-retrieval)
      - [Special Classes](#special-classes)
        - [PackageMap](#packagemap)
        - [NamespaceMap](#namespacemap)
    - [Global Configuration](#global-configuration)
  - [Versioning](#versioning)
  - [Testing](#testing)
  - [Authors](#authors)
    - [Acknowledgement](#acknowledgement)
  - [License](#license)

## Installation

``` bash
composer require mcstreetguy/composer-parser
```

## Usage

### Parsing

I recommend using the provided magic Factory method for parsing:

``` php
use MCStreetguy\ComposerParser\Factory as ComposerParser;

$composerJson = ComposerParser::parse('/path/to/composer.json');
$lockfile = ComposerParser::parse('/path/to/composer.lock');
```

Even if this is the easiest way to retrieve an instance, it may be that you
for some reason cannot rely on these automations (e.g. if you got a differing filename).
In this case you can also call the parse methods directly:

``` php
$composerJson = ComposerParser::parseComposerJson('/some/file');
$lockfile = ComposerParser::parseLockfile('/another/file');
```

_Please note_ that ComposerParser will not complain about any missing fields, instead
it fills all missing values with default ones to ensure integrity.    

#### Exception Handling

During instatiation through the Factory, two exceptions may occur:

``` php
try {
    $composerJson = ComposerParser::parse('/path/to/composer.json');
} catch (InvalidArgumentException $e) {
    // The given file could not be found or is not readable
} catch (RuntimeException $e) {
    // The given file contained an invalid JSON string
}
```

#### Doing it the manual way

If you can not rely on the Factory for any reason, you can also instantiate the class directly.  
**This is however not recommended and may lead to unexpected behaviour.**

``` php
use \MCStreetguy\ComposerParse\ComposerJson;

$rawData = file_get_contents('/path/to/composer.json');
$parsedData = json_decode($rawData, true);

$composerJson = new ComposerJson($parsedData);
```

As you can see the constructor needs an array with the parsed json data.
This applies to all constructor methods throughout the library.

##### Sub-components

You can also create sub-components directly.
In this case you have to keep in mind, that their constructors only accept the isolated data from the composer manifest
(e.g. the `Author` class expects you to pass only the contents of one of the objects in the `author`-field).

``` php
use \MCStreetguy\ComposerParse\Json\Author;

$rawData = file_get_contents('/path/to/composer.json');
$parsedData = json_decode($rawData, true);

$author = new Author($parsedData['authors'][0]);
```

### Data Retrieval

All class instances provide getters for their properties.
The structure is directly adapted from [the composer.json schema](https://getcomposer.org/doc/04-schema.md).
The corresponding property names of wrapper classes have been converted to camelCase (see the [PSR-1 standard](https://www.php-fig.org/psr/psr-1/#4-class-constants-properties-and-method) for further information).

For any property you can use the provided getter methods.

``` php
$license = $composerJson->getLicense();
$version = $composerJson->getVersion();
```

It's also possible to directly access properties. _Please note_ that this is read-only!

``` php
$description = $composerJson->description;
$require = $composerJson->require;
```

You may also call `empty()` or `isset()` on the class properties.    
To check if the whole wrapper is empty (useful for nested classes) there is an `isEmpty()` method inherited:

``` php
if ($composerJson->config->isEmpty()) {
    // Do something
}
```

#### Special Classes

ComposerParser uses some special classes for parts of the json schema.

##### PackageMap

The PackageMap class is used for the fields `require`, `require-dev`, `conflict`, `replace`, `provide` and `suggest`.
It converts a json structure like this:

``` json
{
    "require": {
        "vendor/package": "^2.3",
        "foo/bar": "dev-master"
    }
}
```

into an array structure like this:

``` php
$require = [
    [
        "package" => "vendor/package",
        "version" => "^2.3"
    ],
    [
        "package" => "foo/bar",
        "version" => "dev-master"
    ]
]
```

Additionally it implements the Iterator and ArrayAccess interfaces, thus you may directly access it's contents or put it in a foreach loop:

``` php
$require = $composerJson->getRequire();

$fooBar = $require[1];

foreach ($require as $requirement) {
    $package = $requirement['package'];
    $version = $requirement['version'];

    echo "I need $package at version $version!";
}
```

If you for some reason need the original mapped data you can retrieve it as following:

``` php
$map = $require->getData();
```

##### NamespaceMap

The NamespaceMap is used for the fields `autoload.psr-0` and `autoload.psr-4`.
In fact this class is identical to the [PackageMap](#packagemap). The only difference are the map keys:

``` json
{
    "psr-4": {
        "MCStreetguy\\ComposerParser\\": "src/"
    }
}
```

``` php
$psr4 = [
    [
        "namespace" => "MCStreetguy\\ComposerParser\\",
        "source" => "src/"
    ]
]
```

### Global Configuration

By default, the library tries to load your global configuration file, if there is any.
It follows the location rules for the composer home directory [as defined in the documentation](https://getcomposer.org/doc/03-cli.md#composer-home).
If there is no readable global configuration file present, this step is silently skipped.

Just as composer itself, the following precedence rule applies to global configuration files:
> In case global configuration matches local configuration, the local configuration in the project's composer.json always wins.
_([source: https://getcomposer.org/doc/03-cli.md#composer-home-config-json](https://getcomposer.org/doc/03-cli.md#composer-home-config-json))_

You may suppress this behaviour by passing `true` as second parameter to the `parse`, `parseComposerJson` and `parseLockfile` methods.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/MCStreetguy/ComposerParser/tags). 

## Testing

If you contribute to this project, you have to ensure that your changes don't mess up the existing functionality.
Therefore this repository comes with a PhpUnit testing configuration, that you can execute by running `make test`.
See [their documentation](https://phpunit.readthedocs.io/en/8.2/installation.html) on more information on how to install the tool.

## Authors

* **Maximilian Schmidt** - _Owner_ - [MCStreetguy](https://github.com/MCStreetguy/)

See also the list of [contributors](https://github.com/MCStreetguy/ComposerParser/contributors) who participated in this project.

### Acknowledgement

Special thanks go to [antonkomarev](https://github.com/antonkomarev) who helped discovering and fixing several deeply nested bugs in the libraries architecture.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
