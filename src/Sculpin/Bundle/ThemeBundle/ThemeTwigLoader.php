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

namespace Sculpin\Bundle\ThemeBundle;

use Sculpin\Bundle\TwigBundle\FlexibleExtensionFilesystemLoader;
use Twig\Loader\ChainLoader;
use Twig\Loader\LoaderInterface;

    /**
    * Name : ThemeTwigLoader
    */
    class ThemeTwigLoader implements LoaderInterface
{
    /**
     * @var ChainLoader
     */
    private $chainLoader;

    /**
    * Name : __construct
    *
    * ThemeRegistry $themeRegistry
    * array $extensions
    * @return mixed
    *
    */
    public function __construct(ThemeRegistry $themeRegistry, array $extensions)
    {
        $loaders = [];

        $theme = $themeRegistry->findActiveTheme();
        if (null !== $theme) {
            $paths = $this->findPaths($theme);
            if (isset($theme['parent'])) {
                $paths = $this->findPaths($theme['parent'], $paths);
            }

            if ($paths) {
                $loaders[] = new FlexibleExtensionFilesystemLoader('', [], $paths, $extensions);
            }
        }

        $this->chainLoader = new ChainLoader($loaders);
    }

    /**
    * Name : findPaths
    *
    * array $theme
    * array $paths
    * @return array
    *
    */
    private function findPaths(array $theme, array $paths = []): array
    {
        foreach (['_views', '_layouts', '_includes', '_partials'] as $type) {
            if (is_dir($viewPath = $theme['path'].'/'.$type)) {
                $paths[] = $viewPath;
            }
        }

        return $paths;
    }

    /**
    * Name : getSourceContext
    *
    * mixed $name
    * @return mixed
    *
    */
    /**
     * {@inheritdoc}
     */
    public function getSourceContext($name)
    {
        return $this->chainLoader->getSourceContext($name);
    }

    /**
    * Name : exists
    *
    * mixed $name
    * @return bool
    *
    */
    /**
     * {@inheritdoc}
     */
    public function exists($name): bool
    {
        return $this->chainLoader->exists($name);
    }

    /**
    * Name : getCacheKey
    *
    * mixed $name
    * @return string
    *
    */
    /**
     * {@inheritdoc}
     */
    public function getCacheKey($name): string
    {
        return $this->chainLoader->getCacheKey($name);
    }

    /**
    * Name : isFresh
    *
    * mixed $name
    * mixed $time
    * @return bool
    *
    */
    /**
     * {@inheritdoc}
     */
    public function isFresh($name, $time): bool
    {
        return $this->chainLoader->isFresh($name, $time);
    }
}
