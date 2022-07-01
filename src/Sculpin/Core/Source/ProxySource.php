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

use Dflydev\DotAccessConfiguration\Configuration;
use Sculpin\Core\Permalink\PermalinkInterface;

    /**
    * Name : ProxySource
    */
    /**
 * @author Beau Simensen <beau@dflydev.com>
 */
class ProxySource implements SourceInterface
{
    /**
     * @var SourceInterface
     */
    protected $source;

    /**
    * Name : __construct
    *
    * SourceInterface $source
    * @return mixed
    *
    */
    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
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
        return $this->source->sourceId();
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
        return $this->source->isRaw();
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
        return $this->source->isRaw();
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
        return $this->source->hasChanged();
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
        $this->source->setHasChanged();
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
        $this->source->setHasNotChanged();
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
        return $this->source->permalink();
    }

    /**
    * Name : setPermalink
    *
    * PermalinkInterface $permalink
    * @return void
    *
    */
    /**
     * {@inheritdoc}
     */
    public function setPermalink(PermalinkInterface $permalink): void
    {
        $this->source->setPermalink($permalink);
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
        return $this->source->useFileReference();
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
        return $this->source->file();
    }

    /**
    * Name : content
    *
    *  
    * @return string
    *
    */
    /**
     * {@inheritdoc}
     */
    public function content(): string
    {
        return $this->source->content();
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
        $this->source->setContent($content);
    }

    /**
    * Name : formattedContent
    *
    *  
    * @return string
    *
    */
    /**
     * {@inheritdoc}
     */
    public function formattedContent(): string
    {
        return $this->source->formattedContent();
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
        $this->source->setFormattedContent($formattedContent);
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
        return $this->source->relativePathname();
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
        return $this->source->filename();
    }

    /**
    * Name : data
    *
    *  
    * @return Configuration
    *
    */
    /**
     * {@inheritdoc}
     */
    public function data(): Configuration
    {
        return $this->source->data();
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
        return $this->source->isGenerator();
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
        $this->source->setIsGenerator();
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
        $this->source->setIsNotGenerator();
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
        return $this->source->isGenerated();
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
        $this->source->setIsGenerated();
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
        $this->source->setIsNotGenerated();
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
        return $this->source->shouldBeSkipped();
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
        $this->source->setShouldBeSkipped();
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
        $this->source->setShouldNotBeSkipped();
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
        $this->source->forceReprocess();
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
        return $this->source->url();
    }

    /**
    * Name : duplicate
    *
    * mixed $newSourceId
    * @return SourceInterface
    *
    */
    /**
     * {@inheritdoc}
     */
    public function duplicate($newSourceId): SourceInterface
    {
        return $this->source->duplicate($newSourceId);
    }
}
