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

namespace Sculpin\Core\Event;

use Sculpin\Core\Source\SourceInterface;
use Sculpin\Core\Source\SourceSet;

    /**
    * Name : SourceSetEvent
    */
    /**
 * @author Beau Simensen <beau@dflydev.com>
 */
final class SourceSetEvent extends BaseEvent
Event
{
    /**
     * @var SourceSet
     */
    private $sourceSet;

    /**
    * Name : __construct
    *
    * SourceSet $sourceSet
    * @return mixed
    *
    */
    public function __construct(SourceSet $sourceSet)
    {
        $this->sourceSet = $sourceSet;
    }

    /**
    * Name : allSources
    *
    *  
    * @return array
    *
    */
    /**
     * @return SourceInterface[]
     */
    public function allSources(): array
    {
        return $this->sourceSet->allSources();
    }

    /**
    * Name : updatedSources
    *
    *  
    * @return array
    *
    */
    /**
     * @return SourceInterface[]
     */
    public function updatedSources(): array
    {
        return $this->sourceSet->updatedSources();
    }

    /**
    * Name : sourceSet
    *
    *  
    * @return SourceSet
    *
    */
    public function sourceSet(): SourceSet
    {
        return $this->sourceSet;
    }
}
