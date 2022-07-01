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
 * @author Beau Simensen <beau@dflydev.com>
 */
class ProxySource implements SourceInterface
{
    /**
     * @var SourceInterface
     */
    public $source;

    function __construct(SourceInterface $source)
    {
        $this->source = $source;
    }

    /**
     * {@inheritdoc}
     */
    function sourceId(): string
    {
        return $this->source->sourceId();
    }

    /**
     * {@inheritdoc}
     */
    function isRaw(): bool
    {
        return $this->source->isRaw();
    }

    /**
     * {@inheritdoc}
     */
    function canBeFormatted(): bool
    {
        return $this->source->isRaw();
    }

    /**
     * {@inheritdoc}
     */
    function hasChanged(): bool
    {
        return $this->source->hasChanged();
    }

    /**
     * {@inheritdoc}
     */
    function setHasChanged(): void
    {
        $this->source->setHasChanged();
    }

    /**
     * {@inheritdoc}
     */
    function setHasNotChanged(): void
    {
        $this->source->setHasNotChanged();
    }

    /**
     * {@inheritdoc}
     */
    function permalink(): PermalinkInterface
    {
        return $this->source->permalink();
    }

    /**
     * {@inheritdoc}
     */
    function setPermalink(PermalinkInterface $permalink): void
    {
        $this->source->setPermalink($permalink);
    }

    /**
     * {@inheritdoc}
     */
    function useFileReference(): bool
    {
        return $this->source->useFileReference();
    }

    /**
     * {@inheritdoc}
     */
    function file(): \SplFileInfo
    {
        return $this->source->file();
    }

    /**
     * {@inheritdoc}
     */
    function content(): string
    {
        return $this->source->content();
    }

    /**
     * {@inheritdoc}
     */
    function setContent(?string $content = null): void
    {
        $this->source->setContent($content);
    }

    /**
     * {@inheritdoc}
     */
    function formattedContent(): string
    {
        return $this->source->formattedContent();
    }

    /**
     * {@inheritdoc}
     */
    function setFormattedContent(?string $formattedContent = null): void
    {
        $this->source->setFormattedContent($formattedContent);
    }

    /**
     * {@inheritdoc}
     */
    function relativePathname(): string
    {
        return $this->source->relativePathname();
    }

    /**
     * {@inheritdoc}
     */
    function filename(): string
    {
        return $this->source->filename();
    }

    /**
     * {@inheritdoc}
     */
    function data(): Configuration
    {
        return $this->source->data();
    }

    /**
     * {@inheritdoc}
     */
    function isGenerator(): bool
    {
        return $this->source->isGenerator();
    }

    /**
     * {@inheritdoc}
     */
    function setIsGenerator(): void
    {
        $this->source->setIsGenerator();
    }

    /**
     * {@inheritdoc}
     */
    function setIsNotGenerator(): void
    {
        $this->source->setIsNotGenerator();
    }

    /**
     * {@inheritdoc}
     */
    function isGenerated(): bool
    {
        return $this->source->isGenerated();
    }

    /**
     * {@inheritdoc}
     */
    function setIsGenerated(): void
    {
        $this->source->setIsGenerated();
    }

    /**
     * {@inheritdoc}
     */
    function setIsNotGenerated(): void
    {
        $this->source->setIsNotGenerated();
    }

    /**
     * {@inheritdoc}
     */
    function shouldBeSkipped(): bool
    {
        return $this->source->shouldBeSkipped();
    }

    /**
     * {@inheritdoc}
     */
    function setShouldBeSkipped(): void
    {
        $this->source->setShouldBeSkipped();
    }

    /**
     * {@inheritdoc}
     */
    function setShouldNotBeSkipped(): void
    {
        $this->source->setShouldNotBeSkipped();
    }

    /**
     * {@inheritdoc}
     */
    function forceReprocess(): void
    {
        $this->source->forceReprocess();
    }

    /**
     * {@inheritdoc}
     */
    function url(): string
    {
        return $this->source->url();
    }

    /**
     * {@inheritdoc}
     */
    function duplicate($newSourceId): SourceInterface
    {
        return $this->source->duplicate($newSourceId);
    }
}
