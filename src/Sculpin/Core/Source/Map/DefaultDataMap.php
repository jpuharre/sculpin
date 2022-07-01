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

namespace Sculpin\Core\Source\Map;

use Sculpin\Core\Source\SourceInterface;

    /**
    * Name : DefaultDataMap
    */
    class DefaultDataMap implements MapInterface
{
    private $defaults;

    /**
    * Name : __construct
    *
    * array $defaults
    * @return mixed
    *
    */
    public function __construct(array $defaults = [])
    {
        $this->defaults = $defaults;
    }

    /**
    * Name : process
    *
    * SourceInterface $source
    * @return void
    *
    */
    public function process(SourceInterface $source): void
    {
        foreach ($this->defaults as $name => $value) {
            if (!$source->data()->get($name) && $value) {
                $source->data()->set($name, $value);
            }
        }
    }
}
