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
    public function sourceId();

    /**
     * Whether this source is a raw source.
     */
    public function isRaw();

    /**
     * Whether this source can be formatted.
     */
    public function canBeFormatted();

    public function hasChanged();

    /**
     * Mark source as changed.
     */
    public function setHasChanged();

    /**
     * Mark source as not changed.
     */
    public function setHasNotChanged();

    public function permalink();

    public function setPermalink($permalink);

    /**
     * Whether to use file reference reference instead of string content.
     */
    public function useFileReference();

    /**
     * File reference. (if useFileReference)
     */
    public function file();

    /**
     * Content (if not useFileReference)
     */
    public function content();

    public function setContent($content = null);

    /**
     * Formatted content (if not useFileReference)
     */
    public function formattedContent();

    public function setFormattedContent($formattedContent = null);

    public function relativePathname();

    public function filename();

    public function data();

    /**
     * Whether this source is a generator.
     */
    public function isGenerator();

    /**
     * Mark Source as being a generator.
     */
    public function setIsGenerator();

    /**
     * Mark Source as not being a generator.
     */
    public function setIsNotGenerator();

    /**
     * Whether source is generated (from a generator).
     */
    public function isGenerated();

    /**
     * Mark Source as being generated (by a generator).
     */
    public function setIsGenerated();

    /**
     * Mark Source as not being generated (by a generator).
     */
    public function setIsNotGenerated();

    /**
     * Whether this source should be skipped.
     */
    public function shouldBeSkipped();

    /**
     * Mark Source as being skipped.
     */
    public function setShouldBeSkipped();

    /**
     * Mark Source as not being skipped.
     */
    public function setShouldNotBeSkipped();

    /**
     * Force Source to be reprocessed.
     */
    public function forceReprocess();

    /**
     * Get the URL for this source.
     *
     * Convenience method based on the permalink of this source.
     *
     * @return string
     */
    public function url();

    public function duplicate($newSourceId);
}
