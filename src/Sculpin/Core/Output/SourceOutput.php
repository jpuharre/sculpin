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
 * @author Beau Simensen <beau@dflydev.com>
 */
class SourceOutput implements OutputInterface
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
    function outputId(): string
    {
        return $this->source->sourceId();
    }

    /**
     * {@inheritdoc}
     */
    function pathname(): string
    {
        return $this->source->relativePathname();
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
    function hasFileReference(): bool
    {
        return $this->source->useFileReference();
    }

    /**
     * {@inheritdoc}
     */
    function file(): ?\SplFileInfo
    {
        return $this->source->useFileReference() ? $this->source->file() : null;
    }

    /**
     * {@inheritdoc}
     */
    function formattedContent(): ?string
    {
        return $this->source->useFileReference() ? null : $this->source->formattedContent();
    }
}
