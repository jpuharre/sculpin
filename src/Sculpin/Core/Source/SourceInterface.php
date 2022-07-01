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
use Dflydev\DotAccessConfiguration\Configuration;

/**
 * @author Beau Simensen <beau@dflydev.com>
 */
interface SourceInterface
{
    /**
     * @return String
     */
    function sourceId(): string;

    /**
     * Whether this source is a raw source.
     */
    function isRaw(): bool;

    /**
     * Whether this source can be formatted.
     */
    function canBeFormatted(): bool;

    function hasChanged(): bool;

    /**
     * Mark source as changed.
     */
    function setHasChanged(): void;

    /**
     * Mark source as not changed.
     */
    function setHasNotChanged(): void;

    function permalink(): PermalinkInterface;

    function setPermalink(PermalinkInterface $permalink);

    /**
     * Whether to use file reference reference instead of string content.
     */
    function useFileReference(): bool;

    /**
     * File reference. (if useFileReference)
     */
    function file(): \SplFileInfo;

    /**
     * Content (if not useFileReference)
     */
    function content(): ?string;

    function setContent(?string $content = null): void;

    /**
     * Formatted content (if not useFileReference)
     */
    function formattedContent(): ?string;

    function setFormattedContent(?string $formattedContent = null): void;

    function relativePathname(): string;

    function filename(): string;

    function data(): Configuration;

    /**
     * Whether this source is a generator.
     */
    function isGenerator(): bool;

    /**
     * Mark Source as being a generator.
     */
    function setIsGenerator(): void;

    /**
     * Mark Source as not being a generator.
     */
    function setIsNotGenerator(): void;

    /**
     * Whether source is generated (from a generator).
     */
    function isGenerated(): bool;

    /**
     * Mark Source as being generated (by a generator).
     */
    function setIsGenerated(): void;

    /**
     * Mark Source as not being generated (by a generator).
     */
    function setIsNotGenerated(): void;

    /**
     * Whether this source should be skipped.
     */
    function shouldBeSkipped(): bool;

    /**
     * Mark Source as being skipped.
     */
    function setShouldBeSkipped(): void;

    /**
     * Mark Source as not being skipped.
     */
    function setShouldNotBeSkipped(): void;

    /**
     * Force Source to be reprocessed.
     */
    function forceReprocess(): void;

    /**
     * Get the URL for this source.
     *
     * Convenience method based on the permalink of this source.
     *
     * @return string
     */
    function url(): string;

    function duplicate(string $newSourceId): SourceInterface;
}
