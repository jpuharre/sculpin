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

/**
 * The converter context provides the content that needs to be converted.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
interface ConverterContextInterface
{
    /**
     * Provide the source content.
     */
    public function content(): string;

    /**
     * Set the converted content.
     */
    public function setContent(string $content): void ;
}
