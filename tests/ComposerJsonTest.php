<?php
namespace MCStreetguy\ComposerParser\Tests;

use MCStreetguy\ComposerParser\ComposerJson;
use MCStreetguy\ComposerParser\Json\Autoload;
use MCStreetguy\ComposerParser\Service\PackageMap;
use MCStreetguy\ComposerParser\Json\Repository;
use PHPUnit\Framework\TestCase;

class ComposerJsonTest extends TestCase
{
    /** */
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

        return $composerJson;
    }

    /**
     * @depends testCanConstruct
     */
    public function testCanGetValidData(ComposerJson $composerJson)
    {
        $this->assertEquals('mcstreetguy/composer-parser', $composerJson->getName());
        $this->assertEquals('A composer.json and lockfile parser.', $composerJson->getDescription());
        $this->assertEquals('library', $composerJson->getType());
        $this->assertEquals('https://github.com/MCStreetguy/ComposerLockParser', $composerJson->getHomepage());

        $license = $composerJson->getLicense();
        $this->assertIsArray($license);
        $this->assertContains('MIT', $license);

        $authors = $composerJson->getAuthors();
        $this->assertIsArray($authors);
        $this->assertCount(1, $authors);

        $this->assertInstanceOf(Autoload::class, $composerJson->getAutoload());
        $this->assertInstanceOf(Autoload::class, $composerJson->getAutoloadDev());

        $repositories = $composerJson->getRepositories();
        $this->assertIsArray($repositories);
        $this->assertCount(1, $repositories);
        $this->assertArrayHasKey('packagist.org', $repositories);
        $this->assertInstanceOf(Repository::class, $repositories['packagist.org']);

        $require = $composerJson->getRequire();
        $this->assertInstanceOf(PackageMap::class, $require);
        $this->assertCount(0, $require);

        $requireDev = $composerJson->getRequireDev();
        $this->assertInstanceOf(PackageMap::class, $requireDev);
        $this->assertCount(1, $requireDev);
        $this->assertContains([
            "package" => "mcstreetguy/tempearly",
            "version" => "^0.4.2",
        ], $requireDev);
    }
}
