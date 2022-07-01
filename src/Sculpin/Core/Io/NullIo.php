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

namespace Sculpin\Core\Io;

    /**
    * Name : NullIo
    */
    /**
 * IOInterface that is not interactive and never writes the output
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class NullIo implements IoInterface
{
    /**
    * Name : isInteractive
    *
    *  
    * @return bool
    *
    */
    /**
     * {@inheritDoc}
     */
    public function isInteractive(): bool
    {
        return false;
    }

    /**
    * Name : isVerbose
    *
    *  
    * @return bool
    *
    */
    /**
     * {@inheritDoc}
     */
    public function isVerbose(): bool
    {
        return false;
    }

    /**
    * Name : isVeryVerbose
    *
    *  
    * @return bool
    *
    */
    /**
     * {@inheritDoc}
     */
    public function isVeryVerbose(): bool
    {
        return false;
    }

    /**
    * Name : isDebug
    *
    *  
    * @return bool
    *
    */
    /**
     * {@inheritDoc}
     */
    public function isDebug(): bool
    {
        return false;
    }

    /**
    * Name : isDecorated
    *
    *  
    * @return bool
    *
    */
    /**
     * {@inheritDoc}
     */
    public function isDecorated(): bool
    {
        return false;
    }

    /**
    * Name : write
    *
    * mixed $messages
    * bool $newline
    * @return mixed
    *
    */
    /**
     * {@inheritDoc}
     */
    public function write($messages, bool $newline = true)
    {
    }

    /**
    * Name : overwrite
    *
    * mixed $messages
    * bool $newline
    * ?|int $size
    * @return mixed
    *
    */
    /**
     * {@inheritDoc}
     */
    public function overwrite($messages, bool $newline = true, ?int $size = 80)
    {
    }
}
