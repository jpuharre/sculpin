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

namespace Sculpin\Core\Converter;

use Sculpin\Core\Source\SourceInterface;

    /**
    * Name : SourceConverterContext
    */
    /**
 * Provide a source as converter context.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class SourceConverterContext implements ConverterContextInterface
{
    /**
     * @var SourceInterface
     */
    private $source;

    /**
    * Name : __construct
    *
    * SourceInterface $source
    * @return mixed
    *
    */
    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
    }

    /**
    * Name : content
    *
    *  
    * @return string
    *
    */
    /**
     * {@inheritdoc}
     */
    public function content(): string
    {
        return $this->source->content();
    }

    /**
    * Name : setContent
    *
    * string $content
    * @return void
    *
    */
    /**
     * {@inheritdoc}
     */
    public function setContent(string $content): void
    {
        $this->source->setContent($content);
    }
}
