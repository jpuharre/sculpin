<?php

declare(strict_types=1);

namespace Sculpin\Core\Converter;

    /**
    * Name : ParserInterface
    */
    /**
 * A parser transforms input data into the corresponding output data.
 */
interface ParserInterface
{
    /**
    * Name : transform
    *
    * string $content
    * @return string
    *
    */
    public function transform(string $content): string;
}
