# Composer Lock Parser

## Installation

``` bash
$ composer require mcstreetguy/composer-lock-parser
```

## Initialization

``` php
$lockfile = new MCStreetguy\ComposerLockParser();
$lockfile->parse('./composer.lock');
```

## Usage

The following methods are available:

**class ComposerLockParser**

| Method | Returns |
|:------:|:-------:|
| `parse($path)` | `void` |
| `getPackages()` | `array<Package>` |
| `getDevPackages()` | `array<Package>` |

**class Package**

| Method | Returns |
|:------:|:-------:|
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
|:------:|:-------:|
| `getType()` | `string` |
| `getUrl()` | `string` |
| `getReference()` | `string` |

**class Dist**

| Method | Returns |
|:------:|:-------:|
| `getType()` | `string` |
| `getUrl()` | `string` |
| `getReference()` | `string` |
| `getShaSum()` | `string` |