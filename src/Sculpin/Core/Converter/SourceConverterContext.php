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

namespace Sculpin\Core\Converter;

use Sculpin\Core\Source\SourceInterface;

/**
 * Provide a source as converter context.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class SourceConverterContext implements ConverterContextInterface
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
    function content(): string
    {
        return $this->source->content();
    }

    /**
     * {@inheritdoc}
     */
    function setContent(string $content): void
    {
        $this->source->setContent($content);
    }
}
