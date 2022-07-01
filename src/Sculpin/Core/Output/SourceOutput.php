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
use Sculpin\Core\Source\SourceInterface;

    /**
    * Name : SourceOutput
    */
    /**
 * @author Beau Simensen <beau@dflydev.com>
 */
class SourceOutput implements OutputInterface
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
    * Name : outputId
    *
    *  
    * @return string
    *
    */
    /**
     * {@inheritdoc}
     */
    public function outputId(): string
    {
        return $this->source->sourceId();
    }

    /**
    * Name : pathname
    *
    *  
    * @return string
    *
    */
    /**
     * {@inheritdoc}
     */
    public function pathname(): string
    {
        return $this->source->relativePathname();
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
    * Name : hasFileReference
    *
    *  
    * @return bool
    *
    */
    /**
     * {@inheritdoc}
     */
    public function hasFileReference(): bool
    {
        return $this->source->useFileReference();
    }

    /**
    * Name : file
    *
    *  
    * @return ?|\SplFileInfo
    *
    */
    /**
     * {@inheritdoc}
     */
    public function file(): ?\SplFileInfo
    {
        return $this->source->useFileReference() ? $this->source->file() : null;
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
        return $this->source->useFileReference() ? null : $this->source->formattedContent();
    }
}
