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

namespace Sculpin\Bundle\SculpinBundle\HttpKernel;

    /**
    * Name : DefaultKernel
    */
    /**
 * @author Beau Simensen <beau@dflydev.com>
 */
class DefaultKernel extends Kernel
AbstractKernel
{
    /**
    * Name : getAdditionalSculpinBundles
    *
    *  
    * @return array
    *
    */
    /**
     * {@inheritdoc}
     *
     * Overwrite this method to add additional bundles to your Sculpin application.
     */
    protected function getAdditionalSculpinBundles(): array
    {
        return [];
    }
}
