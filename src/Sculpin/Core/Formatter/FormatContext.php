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

namespace Sculpin\Core\Formatter;

use Dflydev\DotAccessConfiguration\Configuration as Data;

    /**
    * Name : FormatContext
    */
    /**
 * @author Beau Simensen <beau@dflydev.com>
 */
final class FormatContext
{
    /**
     * @var string
     */
    private $templateId;

    /**
     * @var string
     */
    private $template;

    /**
     * @var Data
     */
    private $data;

    /**
    * Name : __construct
    *
    * string $templateId
    * string $template
    * array $data
    * @return mixed
    *
    */
    public function __construct(string $templateId, string $template, array $data)
    {
        $this->templateId = $templateId;
        $this->template = $template;
        $this->data = new Data($data);
    }

    /**
    * Name : templateId
    *
    *  
    * @return string
    *
    */
    public function templateId(): string
    {
        return $this->templateId;
    }

    /**
    * Name : template
    *
    *  
    * @return string
    *
    */
    public function template(): string
    {
        return $this->template;
    }

    /**
    * Name : data
    *
    *  
    * @return Data
    *
    */
    public function data(): Data
    {
        return $this->data;
    }

    /**
    * Name : formatter
    *
    *  
    * @return ?|string
    *
    */
    public function formatter(): ?string
    {
        return $this->data->get('formatter');
    }
}
