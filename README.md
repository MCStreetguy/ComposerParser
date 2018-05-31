# Composer Parser
A parser library for composer.json and lockfiles.

## Installation

``` bash
$ composer require mcstreetguy/composer-parser
```

## Usage
I recommend using the provided magic factory method for parsing:

``` php
use MCStreetguy\ComposerParser\Factory as ComposerParser;

$composerJson = ComposerParser::parse('/path/to/composer.json');
$lockfile = ComposerParser::parse('/path/to/composer.lock');
```

Even if this is the easiest way to retrieve an instance, it may be that you
for some reason cannot rely on these automations (e.g. if you got a differing filename),
you can also call the parse methods directly:

``` php
$composerJson = ComposerParser::parseComposerJson('/some/file');
$lockfile = ComposerParser::parseLockfile('/another/file');
```

Please note that ComposerParser will not complain about any missing fields, instead
it fills all missing values with default ones to ensure integrity.    