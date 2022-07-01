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

namespace Sculpin\Core\Output;

use Sculpin\Core\Permalink\PermalinkInterface;

/**
 * @author Beau Simensen <beau@dflydev.com>
 */
interface OutputInterface
{
    /**
     * Unique ID
     */
    function outputId(): string;

    /**
     * Pathname (relative)
     */
    function pathname(): string;

    /**
     * Suggested permalink
     */
    function permalink(): PermalinkInterface;

    /**
     * Whether this output has a file reference.
     */
    function hasFileReference(): bool;

    /**
     * File reference. (if hasFileReference)
     */
    function file() :?\SplFileInfo;

    /**
     * Formatted content (if not hasFileReference)
     */
    function formattedContent(): ?string;
}
