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

use Dflydev\DotAccessData\DataInterface;
use Sculpin\Core\Source\ProxySource;

class ProxySourceItem extends ProxySource implements SourceInterface
\ArrayAccess
{
    public $previousItem;
    public $nextItem;

    function id()
    {
        return $this->sourceId();
    }

    function meta()
    {
        return $this->data()->export();
    }

    function url(): string
    {
        return $this->permalink()->relativeUrlPath();
    }

    function date()
    {
        $calculatedDate = $this->data()->get('calculated_date');

        return $calculatedDate ?: $this->data()->get('date');
    }

    function title()
    {
        return $this->data()->get('title');
    }

    function blocks()
    {
        return $this->data()->get('blocks');
    }

    function setBlocks(array $blocks = null)
    {
        $this->data()->set('blocks', $blocks ?: []);
    }

    function previousItem()
    {
        return $this->previousItem;
    }

    function setPreviousItem(ProxySourceItem $item = null)
    {
        $lastPreviousItem = $this->previousItem;
        $this->previousItem = $item;
        if ($lastPreviousItem) {
            // We did have a item before...
            if (!$item || $item->id() !== $lastPreviousItem->id()) {
                // But we no longer have a item or the item we
                // were given does not have the same ID as the
                // last one we had...
                $this->reprocess();
            }
        } elseif ($item) {
            // We didn't have a item before but we do now...
            $this->reprocess();
        }
    }

    function nextItem()
    {
        return $this->nextItem;
    }

    function setNextItem(ProxySourceItem $item = null)
    {
        $lastNextItem = $this->nextItem;
        $this->nextItem = $item;
        if ($lastNextItem) {
            // We did have a item before...
            if (!$item || $item->id() !== $lastNextItem->id()) {
                // But we no longer have a item or the item we
                // were given does not have the same ID as the
                // last one we had...
                $this->reprocess();
            }
        } elseif ($item) {
            // We didn't have a item before but we do now...
            $this->reprocess();
        }
    }

    function reprocess()
    {
        $this->setHasChanged();
    }

    #[\ReturnTypeWillChange]
    function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            throw new \InvalidArgumentException('Proxy source items cannot have values pushed onto them');
        } else {
            if (method_exists($this, $offset)) {
                return call_user_func([$this, $offset, $value]);
            }

            $setMethod = 'set'.ucfirst($offset);
            if (method_exists($this, $setMethod)) {
                return call_user_func([$this, $setMethod, $value]);
            }

            $this->data()->set($offset, $value);
        }
    }

    #[\ReturnTypeWillChange]
    function offsetExists($offset)
    {
        return ! method_exists($this, $offset) && null !== $this->data()->get($offset);
    }

    #[\ReturnTypeWillChange]
    function offsetUnset($offset)
    {
        if (! method_exists($this, $offset)) {
            $data = $this->data();
            if ($data instanceof DataInterface) {
                $data->remove($offset);
            }
        }
    }

    #[\ReturnTypeWillChange]
    function offsetGet($offset)
    {
        if (method_exists($this, $offset)) {
            return call_user_func([$this, $offset]);
        }

        return $this->data()->get($offset);
    }
}
