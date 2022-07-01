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
    * Name : DraftsFilter
    */
    class DraftsFilter implements FilterInterface
{
    private $publishDrafts;

    /**
    * Name : __construct
    *
    * mixed $publishDrafts
    * @return mixed
    *
    */
    public function __construct($publishDrafts = false)
    {
        $this->publishDrafts = $publishDrafts;
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
        if ($source->data()->get('draft')) {
            if (!$this->publishDrafts) {
                // If we are not configured to publish drafts we should
                // inform the source that it should be skipped. This
                // will ensure that it won't be touched by any other
                // part of the system for this run.
                $source->setShouldBeSkipped();

                return false;
            }
        }

        return true;
    }
}
