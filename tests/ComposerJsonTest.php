<?php
use PHPUnit\Framework\TestCase;

use MCStreetguy\ComposerParser\ComposerJson;

class ComposerJsonTest extends TestCase
{
    public function testCanConstruct()
    {
        $content = json_decode(file_get_contents(__DIR__ . '/../composer.json'), true);

        $composerJson = new ComposerJson($content);

        $this->assertInstanceOf(ComposerJson::class, $composerJson);
        $this->assertObjectHasAttribute('name', $composerJson);
        $this->assertObjectHasAttribute('description', $composerJson);
        $this->assertObjectHasAttribute('version', $composerJson);
        $this->assertObjectHasAttribute('type', $composerJson);
        $this->assertObjectHasAttribute('keywords', $composerJson);
        $this->assertObjectHasAttribute('homepage', $composerJson);
        $this->assertObjectHasAttribute('readme', $composerJson);
        $this->assertObjectHasAttribute('time', $composerJson);
        $this->assertObjectHasAttribute('license', $composerJson);
        $this->assertObjectHasAttribute('authors', $composerJson);
        $this->assertObjectHasAttribute('support', $composerJson);
        $this->assertObjectHasAttribute('require', $composerJson);
        $this->assertObjectHasAttribute('requireDev', $composerJson);
        $this->assertObjectHasAttribute('conflict', $composerJson);
        $this->assertObjectHasAttribute('replace', $composerJson);
        $this->assertObjectHasAttribute('provide', $composerJson);
        $this->assertObjectHasAttribute('suggest', $composerJson);
        $this->assertObjectHasAttribute('autoload', $composerJson);
        $this->assertObjectHasAttribute('autoloadDev', $composerJson);
        $this->assertObjectHasAttribute('includePath', $composerJson);
        $this->assertObjectHasAttribute('targetDir', $composerJson);
        $this->assertObjectHasAttribute('minimumStability', $composerJson);
        $this->assertObjectHasAttribute('preferStable', $composerJson);
        $this->assertObjectHasAttribute('repositories', $composerJson);
        $this->assertObjectHasAttribute('config', $composerJson);
        $this->assertObjectHasAttribute('scripts', $composerJson);
        $this->assertObjectHasAttribute('extra', $composerJson);
        $this->assertObjectHasAttribute('bin', $composerJson);
        $this->assertObjectHasAttribute('archive', $composerJson);
        $this->assertObjectHasAttribute('abandoned', $composerJson);
        $this->assertObjectHasAttribute('nonFeatureBranches', $composerJson);
    }
}
