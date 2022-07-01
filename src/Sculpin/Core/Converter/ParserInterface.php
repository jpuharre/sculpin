<?php

declare(strict_types=1);

namespace Sculpin\Core\Converter;

/**
 * A parser transforms input data into the corresponding output data.
 */
interface ParserInterface
{
    function transform(string $content): string;
}
