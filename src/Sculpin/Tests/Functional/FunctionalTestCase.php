<?php

declare(strict_types=1);


namespace Sculpin\Tests\Functional;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

/**
 * This test case allows you to create a test project on the fly,
 * and run the sculpin binary against it. Test project files
 * will automatically be created and removed with every test.
 */
class FunctionalTestCase extends TestCase
{
    const PROJECT_DIR = '/__SculpinTestProject__';

    /** @var Filesystem */
    public static $fs;

    /** @var string */
    public $executeOutput;

    /** @var string */
    public $errorOutput;

    static function setUpBeforeClass(): void
    {
        static::$fs = new Filesystem();
    }

    function setUp(): void
    {
        parent::setUp();

        $this->setUpTestProject();
    }

    function setUpTestProject(): void
    {
        $this->tearDownTestProject();

        $projectFiles = [
            '/app/config/sculpin_kernel.yml',
            '/app/config/sculpin_site.yml',
            '/source/_layouts/default.html.twig',
            '/source/_layouts/raw.html.twig',
        ];

        foreach ($projectFiles as $file) {
            $this->addProjectFile($file);
        }

        $this->writeToProjectFile('/source/_layouts/default.html.twig', '{% block content %}{% endblock content %}');
        $this->writeToProjectFile(
            '/source/_layouts/raw.html.twig',
            '{% extends "default" %}{% block content %}{% endblock content %}'
        );
    }

    function tearDownTestProject(): void
    {
        $projectDir = static::projectDir();
        if (static::$fs->exists($projectDir)) {
            static::$fs->remove($projectDir);
        }
    }

    /**
     * Execute a command against the sculpin binary
     * @param string $command
     */
    function executeSculpin($command): void
    {
        $process = $this->executeSculpinAsync($command, false);
        $process->run();
        $this->executeOutput = $process->getOutput();
        $this->errorOutput = $process->getErrorOutput();

        // This is a temporary assertion for diagnostic purposes.
        // When adding tests that analyze error output,
        // you are welcome to move this to its own specific test.
        self::assertSame('', $this->errorOutput, 'Execution output should not contain errors');
    }

    /**
     * Asynchronously execute a command against the sculpin binary
     *
     * Remember to stop the process when finished!
     *
     * @param string   $command
     * @param bool     $start     Default: start the process right away
     * @param callable $callback
     *
     * @return Process
     */
    function executeSculpinAsync(string $command, bool $start = true, ?callable $callback = null): Process
    {
        $binPath    = __DIR__ . '/../../../../bin';
        $projectDir = static::projectDir();
        $process    = new Process("$binPath/sculpin $command --project-dir $projectDir --env=test");

        if ($start) {
            $process->start($callback);
        }

        return $process;
    }

    /**
     * @param string $path
     * @param bool $recursive
     */
    function addProjectDirectory(string $path, bool $recursive = true): void
    {
        $pathParts = explode('/', $path);
        // Remove leading slash
        array_shift($pathParts);

        $projectDir = static::projectDir();

        if (!$recursive) {
            static::$fs->mkdir("$projectDir/$path");
            return;
        }

        $currPath = "$projectDir/";
        foreach ($pathParts as $dir) {
            $currPath .= "$dir/";
            if (!static::$fs->exists($currPath)) {
                static::$fs->mkdir($currPath);
            }
        }
    }

    /**
     * @param string $filePath
     * @param string $content
     */
    function addProjectFile(string $filePath, ?string $content = null): void
    {
        $dirPathParts = explode('/', $filePath);
        // Remove leading slash
        array_shift($dirPathParts);
        // Remove file name
        array_pop($dirPathParts);

        // Add the file directories
        $hasDirectoryPath = !empty($dirPathParts);
        if ($hasDirectoryPath) {
            $dirPath = '/' . join('/', $dirPathParts);
            $this->addProjectDirectory($dirPath);
        }

        // Create the file
        static::$fs->touch(static::projectDir() . $filePath);

        // Add content to the file
        if (!is_null($content)) {
            $this->writeToProjectFile($filePath, $content);
        }
    }

    /**
     * @param string $fixturePath
     * @param string $projectPath
     */
    function copyFixtureToProject(string $fixturePath, string $projectPath): void
    {
        static::$fs->copy($fixturePath, static::projectDir() . $projectPath);
    }

    /**
     * @param string        $filePath
     * @param string|null   $msg
     */
    function assertProjectHasFile(string $filePath, ?string $msg = null): void
    {
        $msg = $msg ?: "Expected project to contain file at path $filePath.";

        $this->assertTrue(static::$fs->exists(static::projectDir() . $filePath), $msg);
    }

    /**
     * @param string        $filePath
     * @param string|null   $msg
     */
    function assertProjectLacksFile(string $filePath, ?string $msg = null): void
    {
        $msg = $msg ?: "Expected project to NOT contain file at path $filePath.";

        $this->assertFalse(static::$fs->exists(static::projectDir() . $filePath), $msg);
    }

    /**
     * @param string $filePath
     * @param string|null $msg
     */
    function assertProjectHasGeneratedFile(string $filePath, ?string $msg = null): void
    {
        $outputDir = '/output_test';

        $msg = $msg ?: "Expected project to have generated file at path $filePath.";
        $this->assertProjectHasFile($outputDir . $filePath, $msg);
    }

    /**
     * @param string $filePath
     * @param string $expected
     * @param string|null $msg
     */
    function assertGeneratedFileHasContent(string $filePath, string $expected, ?string $msg = null): void
    {
        $outputDir = '/output_test';

        $msg        = $msg ?: "Expected generated file at path $filePath to have content '$expected'.";
        $fullPath   = static::projectDir() . $outputDir . $filePath;
        $fileExists = static::$fs->exists($fullPath);

        $this->assertTrue($fileExists, $msg . ' (File Not Found!)');

        $contents = file_get_contents($fullPath);
        $this->assertStringContainsString($expected, $contents, $msg);
    }

    /**
     * @param string $filePath
     * @param string $content
     */
    function writeToProjectFile(string $filePath, string $content): void
    {
        static::$fs->dumpFile(static::projectDir() . $filePath, $content);
    }

    /**
     * @param string $filePath
     * @return Crawler
     */
    function crawlGeneratedProjectFile(string $filePath): Crawler
    {
        return $this->crawlProjectFile('/output_test' . $filePath);
    }

    /**
     * @param string $filePath
     * @return Crawler
     */
    function crawlProjectFile(string $filePath): Crawler
    {
        return $this->crawlFile(static::projectDir() . $filePath);
    }

    /**
     * @param string $filePath
     * @return Crawler
     */
    function crawlFile(string $filePath): Crawler
    {
        $content = $this->readFile($filePath);

        return new Crawler($content);
    }

    /**
     * @param $filePath
     * @return string
     */
    function readFile(string $filePath): string
    {
        if (!static::$fs->exists($filePath)) {
            throw new \PHPUnit\Framework\Exception("Unable to read file at path $filePath: file does not exist");
        }

        $content = file_get_contents($filePath);
        if ($content === false) {
            throw new \PHPUnit\Framework\Exception("Unable to read file at path $filePath: failed to read file.");
        }

        return $content;
    }

    /**
     * @return string
     */
    static function projectDir(): string
    {
        return __DIR__ . static::PROJECT_DIR;
    }
}
