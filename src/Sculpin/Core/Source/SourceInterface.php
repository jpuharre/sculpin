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
    * Name : SourceInterface
    */
    /**
 * @author Beau Simensen <beau@dflydev.com>
 */
interface SourceInterface
{
    /**
    * Name : sourceId
    *
    *  
    * @return string
    *
    */
    /**
     * @return String
     */
    public function sourceId(): string;

    /**
    * Name : isRaw
    *
    *  
    * @return bool
    *
    */
    /**
     * Whether this source is a raw source.
     */
    public function isRaw(): bool;

    /**
    * Name : canBeFormatted
    *
    *  
    * @return bool
    *
    */
    /**
     * Whether this source can be formatted.
     */
    public function canBeFormatted(): bool;

    /**
    * Name : hasChanged
    *
    *  
    * @return bool
    *
    */
    public function hasChanged(): bool;

    /**
    * Name : setHasChanged
    *
    *  
    * @return void
    *
    */
    /**
     * Mark source as changed.
     */
    public function setHasChanged(): void;

    /**
    * Name : setHasNotChanged
    *
    *  
    * @return void
    *
    */
    /**
     * Mark source as not changed.
     */
    public function setHasNotChanged(): void;

    /**
    * Name : permalink
    *
    *  
    * @return PermalinkInterface
    *
    */
    public function permalink(): PermalinkInterface;

    /**
    * Name : setPermalink
    *
    * PermalinkInterface $permalink
    * @return mixed
    *
    */
    public function setPermalink(PermalinkInterface $permalink);

    /**
    * Name : useFileReference
    *
    *  
    * @return bool
    *
    */
    /**
     * Whether to use file reference reference instead of string content.
     */
    public function useFileReference(): bool;

    /**
    * Name : file
    *
    *  
    * @return \SplFileInfo
    *
    */
    /**
     * File reference. (if useFileReference)
     */
    public function file(): \SplFileInfo;

    /**
    * Name : content
    *
    *  
    * @return ?|string
    *
    */
    /**
     * Content (if not useFileReference)
     */
    public function content(): ?string;

    /**
    * Name : setContent
    *
    * ?|string $content
    * @return void
    *
    */
    public function setContent(?string $content = null): void;

    /**
    * Name : formattedContent
    *
    *  
    * @return ?|string
    *
    */
    /**
     * Formatted content (if not useFileReference)
     */
    public function formattedContent(): ?string;

    /**
    * Name : setFormattedContent
    *
    * ?|string $formattedContent
    * @return void
    *
    */
    public function setFormattedContent(?string $formattedContent = null): void;

    /**
    * Name : relativePathname
    *
    *  
    * @return string
    *
    */
    public function relativePathname(): string;

    /**
    * Name : filename
    *
    *  
    * @return string
    *
    */
    public function filename(): string;

    /**
    * Name : data
    *
    *  
    * @return Configuration
    *
    */
    public function data(): Configuration;

    /**
    * Name : isGenerator
    *
    *  
    * @return bool
    *
    */
    /**
     * Whether this source is a generator.
     */
    public function isGenerator(): bool;

    /**
    * Name : setIsGenerator
    *
    *  
    * @return void
    *
    */
    /**
     * Mark Source as being a generator.
     */
    public function setIsGenerator(): void;

    /**
    * Name : setIsNotGenerator
    *
    *  
    * @return void
    *
    */
    /**
     * Mark Source as not being a generator.
     */
    public function setIsNotGenerator(): void;

    /**
    * Name : isGenerated
    *
    *  
    * @return bool
    *
    */
    /**
     * Whether source is generated (from a generator).
     */
    public function isGenerated(): bool;

    /**
    * Name : setIsGenerated
    *
    *  
    * @return void
    *
    */
    /**
     * Mark Source as being generated (by a generator).
     */
    public function setIsGenerated(): void;

    /**
    * Name : setIsNotGenerated
    *
    *  
    * @return void
    *
    */
    /**
     * Mark Source as not being generated (by a generator).
     */
    public function setIsNotGenerated(): void;

    /**
    * Name : shouldBeSkipped
    *
    *  
    * @return bool
    *
    */
    /**
     * Whether this source should be skipped.
     */
    public function shouldBeSkipped(): bool;

    /**
    * Name : setShouldBeSkipped
    *
    *  
    * @return void
    *
    */
    /**
     * Mark Source as being skipped.
     */
    public function setShouldBeSkipped(): void;

    /**
    * Name : setShouldNotBeSkipped
    *
    *  
    * @return void
    *
    */
    /**
     * Mark Source as not being skipped.
     */
    public function setShouldNotBeSkipped(): void;

    /**
    * Name : forceReprocess
    *
    *  
    * @return void
    *
    */
    /**
     * Force Source to be reprocessed.
     */
    public function forceReprocess(): void;

    /**
    * Name : url
    *
    *  
    * @return string
    *
    */
    /**
     * Get the URL for this source.
     *
     * Convenience method based on the permalink of this source.
     *
     * @return string
     */
    public function url(): string;

    /**
    * Name : duplicate
    *
    * string $newSourceId
    * @return SourceInterface
    *
    */
    public function duplicate(string $newSourceId): SourceInterface;
}
