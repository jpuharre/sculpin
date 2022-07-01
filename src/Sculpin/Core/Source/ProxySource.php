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

use Dflydev\DotAccessConfiguration\Configuration;
use Sculpin\Core\Permalink\PermalinkInterface;

/**
 * @author Beau Simensen <beau@dflydev.com>
 */
class ProxySource implements SourceInterface
{
    /**
     * @var SourceInterface
     */
    protected $source;

    public function __construct($source)
    {
        $this->source = $source;
    }

    /**
     * {@inheritdoc}
     */
    public function sourceId(){
        return $this->source->sourceId();
    }

    /**
     * {@inheritdoc}
     */
    public function isRaw(){
        return $this->source->isRaw();
    }

    /**
     * {@inheritdoc}
     */
    public function canBeFormatted(){
        return $this->source->isRaw();
    }

    /**
     * {@inheritdoc}
     */
    public function hasChanged(){
        return $this->source->hasChanged();
    }

    /**
     * {@inheritdoc}
     */
    public function setHasChanged(){
        $this->source->setHasChanged();
    }

    /**
     * {@inheritdoc}
     */
    public function setHasNotChanged(){
        $this->source->setHasNotChanged();
    }

    /**
     * {@inheritdoc}
     */
    public function permalink(){
        return $this->source->permalink();
    }

    /**
     * {@inheritdoc}
     */
    public function setPermalink($permalink){
        $this->source->setPermalink($permalink);
    }

    /**
     * {@inheritdoc}
     */
    public function useFileReference(){
        return $this->source->useFileReference();
    }

    /**
     * {@inheritdoc}
     */
    public function file(){
        return $this->source->file();
    }

    /**
     * {@inheritdoc}
     */
    public function content(){
        return $this->source->content();
    }

    /**
     * {@inheritdoc}
     */
    public function setContent($content = null){
        $this->source->setContent($content);
    }

    /**
     * {@inheritdoc}
     */
    public function formattedContent(){
        return $this->source->formattedContent();
    }

    /**
     * {@inheritdoc}
     */
    public function setFormattedContent($formattedContent = null){
        $this->source->setFormattedContent($formattedContent);
    }

    /**
     * {@inheritdoc}
     */
    public function relativePathname(){
        return $this->source->relativePathname();
    }

    /**
     * {@inheritdoc}
     */
    public function filename(){
        return $this->source->filename();
    }

    /**
     * {@inheritdoc}
     */
    public function data(){
        return $this->source->data();
    }

    /**
     * {@inheritdoc}
     */
    public function isGenerator(){
        return $this->source->isGenerator();
    }

    /**
     * {@inheritdoc}
     */
    public function setIsGenerator(){
        $this->source->setIsGenerator();
    }

    /**
     * {@inheritdoc}
     */
    public function setIsNotGenerator(){
        $this->source->setIsNotGenerator();
    }

    /**
     * {@inheritdoc}
     */
    public function isGenerated(){
        return $this->source->isGenerated();
    }

    /**
     * {@inheritdoc}
     */
    public function setIsGenerated(){
        $this->source->setIsGenerated();
    }

    /**
     * {@inheritdoc}
     */
    public function setIsNotGenerated(){
        $this->source->setIsNotGenerated();
    }

    /**
     * {@inheritdoc}
     */
    public function shouldBeSkipped(){
        return $this->source->shouldBeSkipped();
    }

    /**
     * {@inheritdoc}
     */
    public function setShouldBeSkipped(){
        $this->source->setShouldBeSkipped();
    }

    /**
     * {@inheritdoc}
     */
    public function setShouldNotBeSkipped(){
        $this->source->setShouldNotBeSkipped();
    }

    /**
     * {@inheritdoc}
     */
    public function forceReprocess(){
        $this->source->forceReprocess();
    }

    /**
     * {@inheritdoc}
     */
    public function url(){
        return $this->source->url();
    }

    /**
     * {@inheritdoc}
     */
    public function duplicate($newSourceId){
        return $this->source->duplicate($newSourceId);
    }
}
