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

    /**
    * Name : ProxySourceItem
    */
    class ProxySourceItem extends ProxySource implements SourceInterface
\ArrayAccess
{
    private $previousItem;
    private $nextItem;

    /**
    * Name : id
    *
    *  
    * @return mixed
    *
    */
    public function id()
    {
        return $this->sourceId();
    }

    /**
    * Name : meta
    *
    *  
    * @return mixed
    *
    */
    public function meta()
    {
        return $this->data()->export();
    }

    /**
    * Name : url
    *
    *  
    * @return string
    *
    */
    public function url(): string
    {
        return $this->permalink()->relativeUrlPath();
    }

    /**
    * Name : date
    *
    *  
    * @return mixed
    *
    */
    public function date()
    {
        $calculatedDate = $this->data()->get('calculated_date');

        return $calculatedDate ?: $this->data()->get('date');
    }

    /**
    * Name : title
    *
    *  
    * @return mixed
    *
    */
    public function title()
    {
        return $this->data()->get('title');
    }

    /**
    * Name : blocks
    *
    *  
    * @return mixed
    *
    */
    public function blocks()
    {
        return $this->data()->get('blocks');
    }

    /**
    * Name : setBlocks
    *
    * null|array $blocks
    * @return mixed
    *
    */
    public function setBlocks(array $blocks = null)
    {
        $this->data()->set('blocks', $blocks ?: []);
    }

    /**
    * Name : previousItem
    *
    *  
    * @return mixed
    *
    */
    public function previousItem()
    {
        return $this->previousItem;
    }

    /**
    * Name : setPreviousItem
    *
    * null|ProxySourceItem $item
    * @return mixed
    *
    */
    public function setPreviousItem(ProxySourceItem $item = null)
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

    /**
    * Name : nextItem
    *
    *  
    * @return mixed
    *
    */
    public function nextItem()
    {
        return $this->nextItem;
    }

    /**
    * Name : setNextItem
    *
    * null|ProxySourceItem $item
    * @return mixed
    *
    */
    public function setNextItem(ProxySourceItem $item = null)
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

    /**
    * Name : reprocess
    *
    *  
    * @return mixed
    *
    */
    public function reprocess()
    {
        $this->setHasChanged();
    }

    /**
    * Name : offsetSet
    *
    * mixed $offset
    * mixed $value
    * @return mixed
    *
    */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
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

    /**
    * Name : offsetExists
    *
    * mixed $offset
    * @return mixed
    *
    */
    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return ! method_exists($this, $offset) && null !== $this->data()->get($offset);
    }

    /**
    * Name : offsetUnset
    *
    * mixed $offset
    * @return mixed
    *
    */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        if (! method_exists($this, $offset)) {
            $data = $this->data();
            if ($data instanceof DataInterface) {
                $data->remove($offset);
            }
        }
    }

    /**
    * Name : offsetGet
    *
    * mixed $offset
    * @return mixed
    *
    */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        if (method_exists($this, $offset)) {
            return call_user_func([$this, $offset]);
        }

        return $this->data()->get($offset);
    }
}
