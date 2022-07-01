<?php

declare(strict_types=1);

namespace Sculpin\Tests\Functional;

use Sculpin\Bundle\SculpinBundle\Command\InitCommand;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

    /**
    * Name : InitCommandTest
    */
    class InitCommandTest extends TestCase
FunctionalTestCase
{
    protected const PROJECT_DIR = '/__BlankSculpinProject__';

    /** @var Finder */
    protected $finder;

    /**
    * Name : setUp
    *
    *  
    * @return void
    *
    */
    public function setUp(): void
    {
        $this->tearDownTestProject();
        $this->addProjectDirectory('', $recursive = false);
        $this->finder = new Finder();
    }

    /**
    * Name : shouldInitSpecifiedOutputDir
    *
    *  
    * @return void
    *
    */
    /** @test */
    public function shouldInitSpecifiedOutputDir(): void
    {
        $projectDir = static::projectDir();
        $this->assertProjectEmpty($projectDir);

        $this->executeSculpin('init');

        $this->assertProjectInitialized($projectDir);

        $this->assertYamlFileEqualsArray(
            ['sculpin_content_types' => ['posts' => ['enabled' => false]]],
            $projectDir . '/app/config/sculpin_kernel.yml'
        );

        $this->assertYamlFileEqualsArray(
            [
                'title'                        => InitCommand::DEFAULT_TITLE,
                'subtitle'                     => InitCommand::DEFAULT_SUBTITLE,
                'google_analytics_tracking_id' => '',
                'url'                          => '',
            ],
            $projectDir . '/app/config/sculpin_site.yml'
        );
    }

    /**
    * Name : shouldInitWithSpecifiedParameters
    *
    *  
    * @return void
    *
    */
    /** @test */
    public function shouldInitWithSpecifiedParameters(): void
    {
        $projectDir = static::projectDir();
        $this->assertProjectEmpty($projectDir);

        $this->executeSculpin('init -t "My Custom Title" -s "Custom Subtitle"');

        $this->assertProjectInitialized($projectDir);

        $this->assertYamlFileEqualsArray(
            ['sculpin_content_types' => ['posts' => ['enabled' => false]]],
            $projectDir . '/app/config/sculpin_kernel.yml'
        );

        $this->assertYamlFileEqualsArray(
            [
                'title'                        => 'My Custom Title',
                'subtitle'                     => 'Custom Subtitle',
                'google_analytics_tracking_id' => '',
                'url'                          => '',
            ],
            $projectDir . '/app/config/sculpin_site.yml'
        );
    }

    /**
    * Name : assertProjectEmpty
    *
    * mixed $projectDir
    * @return void
    *
    */
    protected function assertProjectEmpty($projectDir): void
    {
        $files = $this->finder->in($projectDir);
        $this->assertSame(
            [],
            array_keys(iterator_to_array($files)),
            'Expected project dir to be empty'
        );
    }

    /**
    * Name : assertProjectInitialized
    *
    * mixed $projectDir
    * @return void
    *
    */
    protected function assertProjectInitialized($projectDir): void
    {
        $files = $this->finder->in($projectDir);

        $expected = [
            $projectDir . '/app',
            $projectDir . '/app/config',
            $projectDir . '/app/config/sculpin_site.yml',
            $projectDir . '/app/config/sculpin_kernel.yml',
            $projectDir . '/app/SculpinKernel.php',
            $projectDir . '/source',
            $projectDir . '/source/_views',
            $projectDir . '/source/_views/default.html',
            $projectDir . '/source/index.md',
        ];

        $actual = array_keys(iterator_to_array($files));

        sort($expected);
        sort($actual);

        $this->assertSame($expected, $actual);
    }

    /**
    * Name : assertYamlFileEqualsArray
    *
    * array $expected
    * string $file
    * @return void
    *
    */
    protected function assertYamlFileEqualsArray(array $expected, string $file): void
    {
        $this->assertSame($expected, Yaml::parseFile($file));
    }
}
