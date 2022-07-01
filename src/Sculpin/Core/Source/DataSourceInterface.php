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

namespace Sculpin\Core\Source;

    /**
    * Name : DataSourceInterface
    */
    /**
 * @author Beau Simensen <beau@dflydev.com>
 */
interface DataSourceInterface
{
    /**
    * Name : dataSourceId
    *
    *  
    * @return string
    *
    */
    /**
     * @return string
     */
    public function dataSourceId(): string;

    /**
    * Name : refresh
    *
    * SourceSet $sourceSet
    * @return void
    *
    */
    /**
     * Refresh the Source Set with updated Sources.
     *
     * @param SourceSet $sourceSet Source set to be updated
     */
    public function refresh(SourceSet $sourceSet): void;
}
