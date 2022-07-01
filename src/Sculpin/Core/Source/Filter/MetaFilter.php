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

namespace Sculpin\Core\Source\Filter;

use Sculpin\Core\Source\SourceInterface;

class MetaFilter implements FilterInterface
{
    public $key;
    public $value;

    function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    function match(SourceInterface $source): bool
    {
        return $source->data()->get($this->key) === $this->value;
    }
}
