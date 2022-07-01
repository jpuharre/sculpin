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

    /**
    * Name : MetaFilter
    */
    class MetaFilter implements FilterInterface
{
    private $key;
    private $value;

    /**
    * Name : __construct
    *
    * mixed $key
    * mixed $value
    * @return mixed
    *
    */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
    * Name : match
    *
    * SourceInterface $source
    * @return bool
    *
    */
    public function match(SourceInterface $source): bool
    {
        return $source->data()->get($this->key) === $this->value;
    }
}
