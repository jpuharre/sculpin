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

namespace Sculpin\Core\Configuration;

use Dflydev\DotAccessConfiguration\Configuration as BaseConfiguration;

    /**
    * Name : Configuration
    */
    /**
 * @author Beau Simensen <beau@dflydev.com>
 */
class Configuration extends BaseConfiguration
{
    /**
     * Exclusion patterns
     *
     * @var array
     */
    private $excludes = [];

    /**
     * Ignore patterns
     *
     * @var array
     */
    private $ignores = [];

    /**
     * Raw patterns
     *
     * @var array
     */
    private $raws = [];

    /**
     * Source directory
     *
     * @var string
     */
    private $sourceDir;

    /**
     * Output directory
     *
     * @var string
     */
    private $outputDir;

    /**
     * Default permalink
     *
     * @var string
     */
    private $permalink;

    /**
     * Default formatter
     *
     * @var string
     */
    private $defaultFormatter;

    /**
    * Name : setExcludes
    *
    * array $excludes
    * @return self
    *
    */
    /**
     * Set excludes
     *
     * NOTE: Does not clear existing values first.
     *
     * @param array $excludes Excludes.
     *
     * @return Configuration
     */
    public function setExcludes(array $excludes = []): self
    {
        foreach ($excludes as $exclude) {
            $this->addExclude($exclude);
        }

        return $this;
    }

    /**
    * Name : addExclude
    *
    * string $pattern
    * @return self
    *
    */
    /**
     * Add an exclude pattern
     *
     * @param string $pattern
     *
     * @return Configuration
     */
    public function addExclude(string $pattern): self
    {
        if (substr($pattern, 0, 2)=='./') {
            $pattern = substr($pattern, 2);
        }

        if (!in_array($pattern, $this->excludes)) {
            $this->excludes[] = $pattern;
        }

        return $this;
    }

    /**
    * Name : excludes
    *
    *  
    * @return array
    *
    */
    /**
     * Excludes
     *
     * @return array
     */
    public function excludes(): array
    {
        return $this->excludes;
    }

    /**
    * Name : setIgnores
    *
    * array $ignores
    * @return self
    *
    */
    /**
     * Set ignores
     *
     * NOTE: Does not clear existing values first.
     *
     * @param array $ignores Ignores.
     *
     * @return Configuration
     */
    public function setIgnores(array $ignores = []): self
    {
        foreach ($ignores as $ignore) {
            $this->addIgnore($ignore);
        }

        return $this;
    }

    /**
    * Name : addIgnore
    *
    * string $pattern
    * @return self
    *
    */
    /**
     * Add an ignore pattern
     *
     * @param string $pattern
     *
     * @return Configuration
     */
    public function addIgnore(string $pattern): self
    {
        if (substr($pattern, 0, 2)=='./') {
            $pattern = substr($pattern, 2);
        }

        if (!in_array($pattern, $this->ignores)) {
            $this->ignores[] = $pattern;
        }

        return $this;
    }

    /**
    * Name : ignores
    *
    *  
    * @return array
    *
    */
    /**
     * Ignores
     *
     * @return array
     */
    public function ignores(): array
    {
        return $this->ignores;
    }

    /**
    * Name : setRaws
    *
    * array $raws
    * @return self
    *
    */
    /**
     * Set raws
     *
     * NOTE: Does not clear existing values first.
     *
     * @param array $raws Raws.
     *
     * @return Configuration
     */
    public function setRaws(array $raws = []): self
    {
        foreach ($raws as $raw) {
            $this->addRaw($raw);
        }

        return $this;
    }

    /**
    * Name : addRaw
    *
    * string $pattern
    * @return self
    *
    */
    /**
     * Add a raw pattern
     *
     * @param string $pattern
     *
     * @return Configuration
     */
    public function addRaw(string $pattern): self
    {
        if (substr($pattern, 0, 2)=='./') {
            $pattern = substr($pattern, 2);
        }
        if (!in_array($pattern, $this->raws)) {
            $this->raws[] = $pattern;
        }

        return $this;
    }

    /**
    * Name : raws
    *
    *  
    * @return array
    *
    */
    /**
     * Raws
     *
     * @return array
     */
    public function raws(): array
    {
        return $this->raws;
    }

    /**
    * Name : setSourceDir
    *
    * string $sourceDir
    * @return self
    *
    */
    /**
     * Set source directory
     *
     * @param string $sourceDir Source directory
     *
     * @return Configuration
     */
    public function setSourceDir(string $sourceDir): self
    {
        $this->sourceDir = $sourceDir;

        return $this;
    }

    /**
    * Name : sourceDir
    *
    *  
    * @return string
    *
    */
    /**
     * Source directory
     *
     * @return string
     */
    public function sourceDir(): string
    {
        return $this->sourceDir;
    }

    /**
    * Name : setOutputDir
    *
    * string $outputDir
    * @return self
    *
    */
    /**
     * Set output directory
     *
     * @param string $outputDir Output directory
     *
     * @return $this
     */
    public function setOutputDir(string $outputDir): self
    {
        $this->outputDir = $outputDir;

        return $this;
    }

    /**
    * Name : outputDir
    *
    *  
    * @return string
    *
    */
    /**
     * Output directory
     *
     * @return string
     */
    public function outputDir(): string
    {
        return $this->outputDir;
    }

    /**
    * Name : setPermalink
    *
    * string $permalink
    * @return self
    *
    */
    /**
     * Set permalink
     *
     * @param string $permalink Permalink
     *
     * @return $this
     */
    public function setPermalink(string $permalink): self
    {
        $this->permalink = $permalink;

        return $this;
    }

    /**
    * Name : permalink
    *
    *  
    * @return string
    *
    */
    /**
     * Permalink
     *
     * @return string
     */
    public function permalink(): string
    {
        return $this->permalink;
    }

    /**
    * Name : setDefaultFormatter
    *
    * string $defaultFormatter
    * @return self
    *
    */
    /**
     * Set default formatter
     *
     * @param string $defaultFormatter Default formatter
     *
     * @return Configuration
     */
    public function setDefaultFormatter(string $defaultFormatter): self
    {
        $this->defaultFormatter = $defaultFormatter;

        return $this;
    }

    /**
    * Name : defaultFormatter
    *
    *  
    * @return string
    *
    */
    /**
     * Default formatter
     *
     * @return string
     */
    public function defaultFormatter(): string
    {
        return $this->defaultFormatter;
    }
}
