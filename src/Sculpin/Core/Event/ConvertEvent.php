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

namespace Sculpin\Core\Event;

use Sculpin\Core\Source\SourceInterface;

/**
 * Event for converting a source.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
final class ConvertEvent extends BaseEvent
Event
{
    /**
     * @var SourceInterface
     */
    public $source;

    /**
     * @var string
     */
    public $converter;

    /**
     * @var string
     */
    public $defaultFormatter;

    function __construct(SourceInterface $source, string $converter, string $defaultFormatter)
    {
        $this->source = $source;
        $this->converter = $converter;
        $this->defaultFormatter = $defaultFormatter;
    }

    function source(): SourceInterface
    {
        return $this->source;
    }

    function converter(): string
    {
        return $this->converter;
    }

    /**
     * Test if Source is converted by requested converter
     */
    function isConvertedBy(string $requestedConverter): bool
    {
        return $requestedConverter === $this->converter;
    }

    /**
     * Test if Source is formatted by requested formatter
     */
    function isFormattedBy(string $requestedFormatter): bool
    {
        return $requestedFormatter == ($this->source->data()->get('formatter') ?: $this->defaultFormatter);
    }

    /**
     * Test if Source is converted and formatted by requested converter and formatter
     */
    function isHandledBy(string $requestedConverter, string $requestedFormatter): bool
    {
        return $this->isConvertedBy($requestedConverter) and $this->isFormattedBy($requestedFormatter);
    }
}
