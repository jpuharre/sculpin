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

namespace Sculpin\Contrib\Taxonomy;

use Sculpin\Contrib\Taxonomy\PermalinkStrategy\PermalinkStrategyInterface;

    /**
    * Name : PermalinkStrategyCollection
    */
    class PermalinkStrategyCollection
{
    protected $strategies;

    /**
    * Name : __construct
    *
    *  
    * @return mixed
    *
    */
    public function __construct()
    {
        $this->strategies = new \SplObjectStorage();
    }

    /**
    * Name : push
    *
    * PermalinkStrategyInterface $strategy
    * @return mixed
    *
    */
    public function push(PermalinkStrategyInterface $strategy)
    {
        $this->strategies->attach($strategy);
    }

    /**
    * Name : process
    *
    * mixed $str
    * @return mixed
    *
    */
    public function process($str)
    {
        foreach ($this->strategies as $strategy) {
            $str = $strategy->process($str);
        }

        return $str;
    }
}
