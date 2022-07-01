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

use Sculpin\Core\Permalink\PermalinkInterface;
use Dflydev\DotAccessConfiguration\Configuration as Data;
use Sculpin\Core\Source\SourceInterface;

    /**
    * Name : AbstractSource
    */
    /**
 * @author Beau Simensen <beau@dflydev.com>
 */
abstract class AbstractSource implements SourceInterface
{
    /**
     * @var string
     */
    protected $sourceId;

    /**
     * @var boolean
     */
    protected $isRaw;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $formattedContent;

    /**
     * @var Data
     */
    protected $data;

    /**
     * @var boolean
     */
    protected $hasChanged;

    /**
     * @var PermalinkInterface
     */
    protected $permalink;

    /**
     * @var \SplFileInfo
     */
    protected $file;

    /**
     * @var string
     */
    protected $relativePathname;

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var boolean
     */
    protected $useFileReference = false;

    /**
     * @var boolean
     */
    protected $canBeFormatted = false;

    /**
     * @var boolean
     */
    protected $isGenerator = false;

    /**
     * @var boolean
     */
    protected $isGenerated = false;

    /**
     * @var boolean
     */
    protected $shouldBeSkipped = false;

    /**
    * Name : init
    *
    * bool $hasChanged
    * @return mixed
    *
    */
    protected function init(bool $hasChanged = false)
    {
        if ($hasChanged) {
            $this->hasChanged = $hasChanged;
        }
        $this->shouldBeSkipped = false;
    }

    /**
    * Name : sourceId
    *
    *  
    * @return string
    *
    */
    /**
     * {@inheritdoc}
     */
    public function sourceId(): string
    {
        return $this->sourceId;
    }

    /**
    * Name : isRaw
    *
    *  
    * @return bool
    *
    */
    /**
     * {@inheritdoc}
     */
    public function isRaw(): bool
    {
        return $this->isRaw;
    }

    /**
    * Name : content
    *
    *  
    * @return ?|string
    *
    */
    /**
     * {@inheritdoc}
     */
    public function content(): ?string
    {
        return $this->content;
    }

    /**
    * Name : setContent
    *
    * ?|string $content
    * @return void
    *
    */
    /**
     * {@inheritdoc}
     */
    public function setContent(?string $content = null): void
    {
        $this->content = $content;

        // If we are setting content, we are going to assume that we should
        // not be using file references on output.
        $this->useFileReference = false;
    }

    /**
    * Name : formattedContent
    *
    *  
    * @return ?|string
    *
    */
    /**
     * {@inheritdoc}
     */
    public function formattedContent(): ?string
    {
        return $this->formattedContent;
    }

    /**
    * Name : setFormattedContent
    *
    * ?|string $formattedContent
    * @return void
    *
    */
    /**
     * {@inheritdoc}
     */
    public function setFormattedContent(?string $formattedContent = null): void
    {
        $this->formattedContent = $formattedContent;
    }

    /**
    * Name : data
    *
    *  
    * @return Data
    *
    */
    /**
     * {@inheritdoc}
     */
    public function data(): Data
    {
        return $this->data;
    }

    /**
    * Name : hasChanged
    *
    *  
    * @return bool
    *
    */
    /**
     * {@inheritdoc}
     */
    public function hasChanged(): bool
    {
        return $this->hasChanged;
    }

    /**
    * Name : setHasChanged
    *
    *  
    * @return void
    *
    */
    /**
     * {@inheritdoc}
     */
    public function setHasChanged(): void
    {
        $this->hasChanged = true;
    }

    /**
    * Name : setHasNotChanged
    *
    *  
    * @return void
    *
    */
    /**
     * {@inheritdoc}
     */
    public function setHasNotChanged(): void
    {
        $this->hasChanged = false;
    }

    /**
    * Name : permalink
    *
    *  
    * @return PermalinkInterface
    *
    */
    /**
     * {@inheritdoc}
     */
    public function permalink(): PermalinkInterface
    {
        return $this->permalink;
    }

    /**
    * Name : setPermalink
    *
    * PermalinkInterface $permalink
    * @return mixed
    *
    */
    /**
     * {@inheritdoc}
     */
    public function setPermalink(PermalinkInterface $permalink)
    {
        $this->permalink = $permalink;
    }

    /**
    * Name : useFileReference
    *
    *  
    * @return bool
    *
    */
    /**
     * {@inheritdoc}
     */
    public function useFileReference(): bool
    {
        return $this->useFileReference;
    }

    /**
    * Name : canBeFormatted
    *
    *  
    * @return bool
    *
    */
    /**
     * {@inheritdoc}
     */
    public function canBeFormatted(): bool
    {
        return $this->canBeFormatted;
    }

    /**
    * Name : isGenerator
    *
    *  
    * @return bool
    *
    */
    /**
     * {@inheritdoc}
     */
    public function isGenerator(): bool
    {
        return $this->isGenerator;
    }

    /**
    * Name : setIsGenerator
    *
    *  
    * @return void
    *
    */
    /**
     * {@inheritdoc}
     */
    public function setIsGenerator(): void
    {
        $this->isGenerator = true;
    }

    /**
    * Name : setIsNotGenerator
    *
    *  
    * @return void
    *
    */
    /**
     * {@inheritdoc}
     */
    public function setIsNotGenerator(): void
    {
        $this->isGenerator = false;
    }

    /**
    * Name : isGenerated
    *
    *  
    * @return bool
    *
    */
    /**
     * {@inheritdoc}
     */
    public function isGenerated(): bool
    {
        return $this->isGenerated;
    }

    /**
    * Name : setIsGenerated
    *
    *  
    * @return void
    *
    */
    /**
     * {@inheritdoc}
     */
    public function setIsGenerated(): void
    {
        $this->isGenerated = true;
    }

    /**
    * Name : setIsNotGenerated
    *
    *  
    * @return void
    *
    */
    /**
     * {@inheritdoc}
     */
    public function setIsNotGenerated(): void
    {
        $this->isGenerated = false;
    }

    /**
    * Name : shouldBeSkipped
    *
    *  
    * @return bool
    *
    */
    /**
     * {@inheritdoc}
     */
    public function shouldBeSkipped(): bool
    {
        return $this->shouldBeSkipped;
    }

    /**
    * Name : setShouldBeSkipped
    *
    *  
    * @return void
    *
    */
    /**
     * {@inheritdoc}
     */
    public function setShouldBeSkipped(): void
    {
        $this->shouldBeSkipped = true;
    }

    /**
    * Name : setShouldNotBeSkipped
    *
    *  
    * @return void
    *
    */
    /**
     * {@inheritdoc}
     */
    public function setShouldNotBeSkipped(): void
    {
        $this->shouldBeSkipped = false;
    }

    /**
    * Name : forceReprocess
    *
    *  
    * @return void
    *
    */
    /**
     * {@inheritdoc}
     */
    public function forceReprocess(): void
    {
        $this->init(true);
    }

    /**
    * Name : relativePathname
    *
    *  
    * @return string
    *
    */
    /**
     * {@inheritdoc}
     */
    public function relativePathname(): string
    {
        return $this->relativePathname;
    }

    /**
    * Name : filename
    *
    *  
    * @return string
    *
    */
    /**
     * {@inheritdoc}
     */
    public function filename(): string
    {
        return $this->filename;
    }

    /**
    * Name : setCanBeFormatted
    *
    *  
    * @return void
    *
    */
    /**
     * Mark source as can be formatted
     */
    public function setCanBeFormatted(): void
    {
        $this->canBeFormatted = true;
    }

    /**
    * Name : file
    *
    *  
    * @return \SplFileInfo
    *
    */
    /**
     * {@inheritdoc}
     */
    public function file(): \SplFileInfo
    {
        return $this->file;
    }

    /**
    * Name : url
    *
    *  
    * @return string
    *
    */
    /**
     * {@inheritdoc}
     */
    public function url(): string
    {
        return $this->permalink()->relativeUrlPath();
    }

    /**
    * Name : duplicate
    *
    * string $newSourceId
    * array $options
    * @return SourceInterface
    *
    */
    /**
     * {@inheritdoc}
     */
    public function duplicate(string $newSourceId, array $options = []): SourceInterface
    {
        return new MemorySource(
            $newSourceId,
            new Data($this->data->exportRaw()),
            isset($options['content']) ? $options['content'] : $this->content,
            isset($options['formattedContent']) ? $options['formattedContent'] : $this->formattedContent,
            isset($options['relativePathname']) ? $options['relativePathname'] : $this->relativePathname,
            isset($options['filename']) ? $options['filename'] : $this->filename,
            isset($options['file']) ? $options['file'] : $this->file,
            isset($options['isRaw']) ? $options['isRaw'] : $this->isRaw,
            isset($options['canBeFormatted']) ? $options['canBeFormatted'] : $this->canBeFormatted,
            isset($options['hasChanged']) ? $options['hasChanged'] : $this->hasChanged
        );
    }
}
