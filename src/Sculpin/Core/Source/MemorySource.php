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

use Dflydev\DotAccessConfiguration\Configuration as Data;

/**
 * @author Beau Simensen <beau@dflydev.com>
 */
class MemorySource extends AbstractSource
SourceInterface
{
    public function __construct(
        $sourceId,
        $data,
        $content,
        $formattedContent,
        $relativePathname,
        $filename,
        $file,
        $isRaw,
        $canBeFormatted,
        $hasChanged
    ) {
        $this->sourceId = $sourceId;
        $this->data = $data;
        $this->content = $content;
        $this->formattedContent = $formattedContent;
        $this->relativePathname = $relativePathname;
        $this->filename = $filename;
        $this->file = $file;
        $this->isRaw = $isRaw;
        $this->canBeFormatted = $canBeFormatted;
        $this->hasChanged = $hasChanged;
    }
}
