# Composer Lock Parser
A parser library for composer lockfiles.

## Installation

``` bash
$ composer require mcstreetguy/composer-lock-parser
```

## Initialization

``` php
$lockfile = new MCStreetguy\ComposerLockParser();
$lockfile->parse('path/to/composer.lock');
```

## Usage
Basically, this library only wraps the values from the lockfile into helper classes.
This allows for an oop-way of accessing the information.

### Example

``` php
$packages = $lockfile->getPackages();

foreach ($packages as $package) {
    $name = $package->getName();
    $author = $package->getAuthors()[0];
    $version = $package->getVersion();
    $url = $package->getSource()->getUrl();

    echo "'$name' by '$author', installed at version '$version' from '$url'.";
}
```

### Reference

**class ComposerLockParser**

| Method | Returns |
|:-------|--------:|
| `parse($path)` | `void` |
| `getPackages()` | `array<Package>` |
| `getDevPackages()` | `array<Package>` |

**class Package**

| Method | Returns |
|:-------|--------:|
| `getName()` | `string` |
| `getVersion()` | `string` |
| `getType()` | `string` |
| `getAuthors()` | `array` |
| `getDescription()` | `string` |
| `getHomepage()` | `string` |
| `getKeywords()` | `array<string>` |
| `getTime()` | `string` |
| `getExtra()` | `array` |
| `getSource()` | `Source` |
| `getDist()` | `Dist` |
| `getRequire()` | `array` |
| `getRequireDev()` | `array` |
| `getLicense()` | `string` |

**class Source**

| Method | Returns |
|:-------|--------:|
| `getType()` | `string` |
| `getUrl()` | `string` |
| `getReference()` | `string` |

**class Dist**

| Method | Returns |
|:-------|--------:|
| `getType()` | `string` |
| `getUrl()` | `string` |
| `getReference()` | `string` |
| `getShaSum()` | `string` |