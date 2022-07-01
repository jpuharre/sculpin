<?php

declare(strict_types=1);

/*
 * This file is a part of Sculpin.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sculpin\Core\Source;

use Dflydev\Canal\Analyzer\Analyzer;
use Symfony\Component\Finder\Finder;
use dflydev\util\antPathMatcher\AntPathMatcher;
use Sculpin\Core\Util\DirectorySeparatorNormalizer;
use Symfony\Component\Finder\SplFileInfo;

/**
 * @author Beau Simensen <beau@dflydev.com>
 */
final class FilesystemDataSource implements DataSourceInterface
{
    /**
     * @var string
     */
    public $sourceDir;

    /**
     * @var string[]
     */
    public $excludePaths;

    /**
     * @var string[]
     */
    public $ignorePaths;

    /**
     * @var string[]
     */
    public $rawPaths;

    /**
     * @var AntPathMatcher
     */
    public $pathMatcher;

    /**
     * @var Analyzer
     */
    public $analyzer;

    /**
     * @var DirectorySeparatorNormalizer
     */
    public $directorySeparatorNormalizer;

    /**
     * @var string
     */
    public $sinceTime;

    /**
     * @param string[] $excludePaths Exclude paths
     * @param string[] $ignorePaths  Ignore paths
     * @param string[] $rawPaths     Raw paths
     */
    function __construct(
        string $sourceDir,
        array $excludePaths,
        array $ignorePaths,
        array $rawPaths,
        AntPathMatcher $matcher = null,
        Analyzer $analyzer = null,
        DirectorySeparatorNormalizer $directorySeparatorNormalizer = null
    ) {
        $this->sourceDir = $sourceDir;
        $this->excludePaths = $excludePaths;
        $this->ignorePaths = $ignorePaths;
        $this->rawPaths = $rawPaths;
        $this->pathMatcher = $matcher ?: new AntPathMatcher;
        $this->analyzer = $analyzer;
        $this->directorySeparatorNormalizer = $directorySeparatorNormalizer ?: new DirectorySeparatorNormalizer;
        $this->sinceTime = '1970-01-01T00:00:00Z';
    }

    /**
     * {@inheritdoc}
     */
    function dataSourceId(): string
    {
        return 'FilesystemDataSource:'.$this->sourceDir;
    }

    /**
     * {@inheritdoc}
     */
    function refresh(SourceSet $sourceSet): void
    {
        $sinceTimeLast = $this->sinceTime;

        $this->sinceTime = date('c');

        // We regenerate the whole site if an excluded file changes.
        $excludedFilesHaveChanged = false;

        $files = Finder::create()
            ->files()
            ->ignoreVCS(true)
            ->ignoreDotFiles(false)
            ->date('>='.$sinceTimeLast)
            ->followLinks()
            ->in($this->sourceDir);

        $sinceTimeLastSeconds = strtotime($sinceTimeLast);

        /** @var SplFileInfo $file */
        foreach ($files as $file) {
            if ($sinceTimeLastSeconds > $file->getMTime()) {
                // This is a hack because Finder is actually incapable
                // of resolution down to seconds.
                //
                // Sometimes this may result in the file looking like it
                // has been modified twice in a row when it has not.
                continue;
            }

            foreach ($this->ignorePaths as $pattern) {
                if (!$this->pathMatcher->isPattern($pattern)) {
                    continue;
                }
                if ($this->pathMatcher->match(
                    $pattern,
                    $this->directorySeparatorNormalizer->normalize($file->getRelativePathname())
                )
                ) {
                    // Ignored files are completely ignored.
                    continue 2;
                }
            }
            foreach ($this->excludePaths as $pattern) {
                if (!$this->pathMatcher->isPattern($pattern)) {
                    continue;
                }
                if ($this->pathMatcher->match(
                    $pattern,
                    $this->directorySeparatorNormalizer->normalize($file->getRelativePathname())
                )
                ) {
                    $excludedFilesHaveChanged = true;
                    continue 2;
                }
            }

            $isRaw = false;

            foreach ($this->rawPaths as $pattern) {
                if (!$this->pathMatcher->isPattern($pattern)) {
                    continue;
                }
                if ($this->pathMatcher->match(
                    $pattern,
                    $this->directorySeparatorNormalizer->normalize($file->getRelativePathname())
                )
                ) {
                    $isRaw = true;
                    break;
                }
            }

            $source = new FileSource($this->analyzer, $this, $file, $isRaw, true);
            $sourceSet->mergeSource($source);
        }

        if ($excludedFilesHaveChanged) {
            // If any of the exluded files have changed we should
            // mark all of the sources as having changed.
            foreach ($sourceSet->allSources() as $source) {
                $source->setHasChanged();
            }
        }
    }
}
