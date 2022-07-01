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

namespace Sculpin\Core\SiteConfiguration;

use Dflydev\DotAccessConfiguration\Configuration;
use Dflydev\DotAccessConfiguration\ConfigurationInterface;
use Dflydev\DotAccessConfiguration\YamlFileConfigurationBuilder;

/**
 * @author Beau Simensen <beau@dflydev.com>
 */
final class SiteConfigurationFactory
{
    /**
     * @var string
     */
    public $rootDir;

    /**
     * @var string
     */
    public $environment;

    function __construct(string $rootDir, string $environment)
    {
        $this->rootDir = $rootDir;
        $this->environment = $environment;
    }

    /**
     * Get an instance of the Configuration() class from the given file.
     *
     * @param  string $configFile
     *
     * @return ConfigurationInterface
     */
    function getConfigFile(string $configFile): ConfigurationInterface
    {
        $builder = new YamlFileConfigurationBuilder([$configFile]);

        return $builder->build();
    }

    /**
     * Create Site Configuration
     *
     * @return ConfigurationInterface
     */
    function create(): ConfigurationInterface
    {
        $config = $this->detectConfig();
        $config->set('env', $this->environment);

        return $config;
    }
    /**
     * Detect configuration file and create Site Configuration from it
     *
     * @return Configuration
     */
    function detectConfig(): ConfigurationInterface
    {
        if (file_exists($file = $this->rootDir.'/config/sculpin_site_'.$this->environment.'.yml')) {
            return $this->getConfigFile($file);
        }

        if (file_exists($file = $this->rootDir.'/config/sculpin_site.yml')) {
            return $this->getConfigFile($file);
        }

        return new Configuration();
    }
}
