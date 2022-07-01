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
    public function outputId();

    /**
     * Pathname (relative)
     */
    public function pathname();

    /**
     * Suggested permalink
     */
    public function permalink();

    /**
     * Whether this output has a file reference.
     */
    public function hasFileReference();

    /**
     * File reference. (if hasFileReference)
     */
    public function file() ;

    /**
     * Formatted content (if not hasFileReference)
     */
    public function formattedContent();
}
