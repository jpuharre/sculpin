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
    * Name : NullConverter
    */
    /**
 * A converter that does nothing.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class NullConverter implements ConverterInterface
{
    /**
    * Name : convert
    *
    * ConverterContextInterface $converterContext
    * @return void
    *
    */
    /**
     * Does nothing.
     */
    public function convert(ConverterContextInterface $converterContext): void
    {
    }
}
