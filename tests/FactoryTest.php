<?php
use PHPUnit\Framework\TestCase;

use MCStreetguy\ComposerParser\Factory;
use MCStreetguy\ComposerParser\Lockfile;
use MCStreetguy\ComposerParser\ComposerJson;

class FactoryTest extends TestCase
{
    public function testCanParseComposerJson()
    {
        $instance = Factory::parseComposerJson(__DIR__ . '/../composer.json');

        $this->assertInstanceOf(ComposerJson::class, $instance);
    }

    public function testCanParseComposerLock()
    {
        $instance = Factory::parseComposerLock(__DIR__ . '/../composer.lock');

        $this->assertInstanceOf(Lockfile::class, $instance);
    }

    public function testCanParse()
    {
        $instance = Factory::parse(__DIR__ . '/../composer.json');

        $this->assertInstanceOf(ComposerJson::class, $instance);

        $instance = Factory::parse(__DIR__ . '/../composer.lock');

        $this->assertInstanceOf(Lockfile::class, $instance);
    }

    public function testCantParseInvalid()
    {
        $this->excpectException(InvalidArgumentException::class);

        Factory::parse(__DIR__ . '/bootstrap.php');
    }
}
