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
    * Name : IoInterface
    */
    /**
 * Defines how to output information and provides meta information on the output.
 *
 * @author François Pluchino <francois.pluchino@opendisplay.com>
 */
interface IoInterface
{
    /**
    * Name : isInteractive
    *
    *  
    * @return bool
    *
    */
    /**
     * Is this an interactive output?
     */
    public function isInteractive(): bool;

    /**
    * Name : isVerbose
    *
    *  
    * @return bool
    *
    */
    /**
     * Is this output verbose?
     */
    public function isVerbose(): bool;

    /**
    * Name : isVeryVerbose
    *
    *  
    * @return bool
    *
    */
    /**
     * Is the output very verbose?
     */
    public function isVeryVerbose(): bool;

    /**
    * Name : isDebug
    *
    *  
    * @return bool
    *
    */
    /**
     * Is the output in debug verbosity?
     */
    public function isDebug(): bool;

    /**
    * Name : isDecorated
    *
    *  
    * @return bool
    *
    */
    /**
     * Is this output decorated?
     */
    public function isDecorated(): bool;

    /**
    * Name : write
    *
    * mixed $messages
    * bool $newline
    * @return mixed
    *
    */
    /**
     * Writes a message to the output.
     *
     * @param string|array $messages The message as an array of lines or a single string
     * @param bool         $newline  Whether to add a newline or not
     */
    public function write($messages, bool $newline = true);

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
     * Overwrites a previous message to the output.
     *
     * @param string|array $messages The message as an array of lines or a single string
     * @param bool         $newline  Whether to add a newline or not
     * @param integer      $size     The size to overwrite (defaults to the whole last line)
     */
    public function overwrite($messages, bool $newline = true, ?int $size = null);
}
