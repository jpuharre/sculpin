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
    * Name : ChainMap
    */
    class ChainMap implements MapInterface
{
    private $maps = [];

    /**
    * Name : __construct
    *
    * array $maps
    * @return mixed
    *
    */
    public function __construct(array $maps = [])
    {
        $this->maps = $maps;
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
        foreach ($this->maps as $map) {
            $map->process($source);
        }
    }

    /**
    * Name : addMap
    *
    * MapInterface $map
    * @return void
    *
    */
    public function addMap(MapInterface $map): void
    {
        $this->maps[] = $map;
    }
}
