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
    * Name : ConverterContextInterface
    */
    /**
 * The converter context provides the content that needs to be converted.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
interface ConverterContextInterface
{
    /**
    * Name : content
    *
    *  
    * @return string
    *
    */
    /**
     * Provide the source content.
     */
    public function content(): string;

    /**
    * Name : setContent
    *
    * string $content
    * @return mixed
    *
    */
    /**
     * Set the converted content.
     */
    public function setContent(string $content);
}
