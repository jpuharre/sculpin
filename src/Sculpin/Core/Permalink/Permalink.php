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

namespace Sculpin\Core\Permalink;

    /**
    * Name : Permalink
    */
    /**
 * @author Beau Simensen <beau@dflydev.com>
 */
class Permalink implements PermalinkInterface
{
    /**
     * @var string
     */
    private $relativeFilePath;

    /**
     * @var string
     */
    private $relativeUrlPath;

    /**
    * Name : __construct
    *
    * string $relativeFilePath
    * string $relativeUrlPath
    * @return mixed
    *
    */
    public function __construct(string $relativeFilePath, string $relativeUrlPath)
    {
        $this->relativeFilePath = $relativeFilePath;
        $this->relativeUrlPath = $relativeUrlPath;
    }

    /**
    * Name : relativeFilePath
    *
    *  
    * @return string
    *
    */
    /**
     * {@inheritdoc}
     */
    public function relativeFilePath(): string
    {
        return $this->relativeFilePath;
    }

    /**
    * Name : relativeUrlPath
    *
    *  
    * @return string
    *
    */
    /**
     * {@inheritdoc}
     */
    public function relativeUrlPath(): string
    {
        return $this->relativeUrlPath;
    }
}
