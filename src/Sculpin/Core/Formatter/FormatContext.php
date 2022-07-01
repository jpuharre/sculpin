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
 * @author Beau Simensen <beau@dflydev.com>
 */
final class FormatContext
{
    /**
     * @var string
     */
    public $templateId;

    /**
     * @var string
     */
    public $template;

    /**
     * @var Data
     */
    public $data;

    function __construct(string $templateId, string $template, array $data)
    {
        $this->templateId = $templateId;
        $this->template = $template;
        $this->data = new Data($data);
    }

    function templateId(): string
    {
        return $this->templateId;
    }

    function template(): string
    {
        return $this->template;
    }

    function data(): Data
    {
        return $this->data;
    }

    function formatter(): ?string
    {
        return $this->data->get('formatter');
    }
}
