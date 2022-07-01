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
    * Name : OutputInterface
    */
    /**
 * @author Beau Simensen <beau@dflydev.com>
 */
interface OutputInterface
{
    /**
    * Name : outputId
    *
    *  
    * @return string
    *
    */
    /**
     * Unique ID
     */
    public function outputId(): string;

    /**
    * Name : pathname
    *
    *  
    * @return string
    *
    */
    /**
     * Pathname (relative)
     */
    public function pathname(): string;

    /**
    * Name : permalink
    *
    *  
    * @return PermalinkInterface
    *
    */
    /**
     * Suggested permalink
     */
    public function permalink(): PermalinkInterface;

    /**
    * Name : hasFileReference
    *
    *  
    * @return bool
    *
    */
    /**
     * Whether this output has a file reference.
     */
    public function hasFileReference(): bool;

    /**
    * Name : file
    *
    *  
    * @return ?|\SplFileInfo
    *
    */
    /**
     * File reference. (if hasFileReference)
     */
    public function file() :?\SplFileInfo;

    /**
    * Name : formattedContent
    *
    *  
    * @return ?|string
    *
    */
    /**
     * Formatted content (if not hasFileReference)
     */
    public function formattedContent(): ?string;
}
