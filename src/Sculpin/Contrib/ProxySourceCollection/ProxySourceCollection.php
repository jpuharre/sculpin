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

namespace Sculpin\Contrib\ProxySourceCollection;

use Sculpin\Contrib\ProxySourceCollection\Sorter\DefaultSorter;
use Sculpin\Contrib\ProxySourceCollection\Sorter\SorterInterface;
use StableSort\StableSort;

class ProxySourceCollection implements \ArrayAccess, \Iterator, \Countable
{
    /**
     * @var ProxySourceItem[] $items
     */
    public $items = [];
    public $sorter;

    function __construct(array $items = [], SorterInterface $sorter = null)
    {
        $this->items = $items;
        $this->sorter = $sorter ?: new DefaultSorter;
    }

    #[\ReturnTypeWillChange]
    function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    #[\ReturnTypeWillChange]
    function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    #[\ReturnTypeWillChange]
    function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    #[\ReturnTypeWillChange]
    function offsetGet($offset)
    {
        return isset($this->items[$offset]) ? $this->items[$offset] : null;
    }

    #[\ReturnTypeWillChange]
    function rewind()
    {
        reset($this->items);
    }

    #[\ReturnTypeWillChange]
    function current()
    {
        return current($this->items);
    }

    #[\ReturnTypeWillChange]
    function key()
    {
        return key($this->items);
    }

    #[\ReturnTypeWillChange]
    function next()
    {
        return next($this->items);
    }

    #[\ReturnTypeWillChange]
    function valid()
    {
        return $this->current() !== false;
    }

    #[\ReturnTypeWillChange]
    function count()
    {
        return count($this->items);
    }

    function init()
    {
        $this->sort();

        /**
         * @var $item ProxySourceItem|null
         */
        $item = null;

        foreach (array_reverse($this->items) as $currItem) {
            if ($item) {
                $item->setNextItem($currItem);
            }
            $currItem->setPreviousItem($item);
            $item = $currItem;
        }

        if ($item) {
            $item->setNextItem(null);
        }
    }

    function first()
    {
        $keys = array_keys($this->items);

        return $this->items[$keys[0]];
    }

    /**
     * Sorts proxy source items using the StableSort algorithm from Martijn van der Lee
     *
     * See: https://github.com/vanderlee/PHP-stable-sort-functions
     */
    function sort()
    {
        $index      = 0;
        $comparator = [$this->sorter, 'sort'];

        // add an index to provide stable sorting
        foreach ($this->items as &$item) {
            $item = [$index++, $item];
        }
        unset($item);

        uasort($this->items, function ($a, $b) use ($comparator) {
            $result = $comparator($a[1], $b[1]);

            // use the index to prevent undefined behaviour when comparator reports items are "equal"
            return $result === 0 ? $a[0] - $b[0] : $result;
        });

        // remove the index
        foreach ($this->items as &$item) {
            $item = $item[1];
        }
        unset($item);
    }
}
