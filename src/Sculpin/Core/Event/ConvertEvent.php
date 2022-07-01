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
    private $source;

    /**
     * @var string
     */
    private $converter;

    /**
     * @var string
     */
    private $defaultFormatter;

    public function __construct($source, $converter, $defaultFormatter)
    {
        $this->source = $source;
        $this->converter = $converter;
        $this->defaultFormatter = $defaultFormatter;
    }

    public function source(){
        return $this->source;
    }

    public function converter(){
        return $this->converter;
    }

    /**
     * Test if Source is converted by requested converter
     */
    public function isConvertedBy($requestedConverter){
        return $requestedConverter === $this->converter;
    }

    /**
     * Test if Source is formatted by requested formatter
     */
    public function isFormattedBy($requestedFormatter){
        return $requestedFormatter == ($this->source->data()->get('formatter') ?: $this->defaultFormatter);
    }

    /**
     * Test if Source is converted and formatted by requested converter and formatter
     */
    public function isHandledBy($requestedConverter, $requestedFormatter){
        return $this->isConvertedBy($requestedConverter) and $this->isFormattedBy($requestedFormatter);
    }
}
