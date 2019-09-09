<?php
namespace MCStreetguy\ComposerParser\Tests;

use MCStreetguy\ComposerParser\ComposerJson;
use MCStreetguy\ComposerParser\Factory;
use MCStreetguy\ComposerParser\Lockfile;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function testCanParseComposerJson()
    {
        $instance = Factory::parseComposerJson(__DIR__ . '/../composer.json');

        $this->assertInstanceOf(ComposerJson::class, $instance);
    }

    public function testCanParseLockfile()
    {
        $instance = Factory::parseLockfile(__DIR__ . '/../composer.lock');

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
        $this->expectException(\InvalidArgumentException::class);

        Factory::parse(__DIR__ . '/bootstrap.php');
    }
}
