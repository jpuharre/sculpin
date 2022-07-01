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

namespace Sculpin\Core\Generator;

use Dflydev\DotAccessConfiguration\Configuration;
use Sculpin\Core\DataProvider\DataProviderManager;
use Sculpin\Core\Source\SourceInterface;
use Sculpin\Core\Source\SourceSet;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

    /**
    * Name : GeneratorManager
    */
    /**
 * @author Beau Simensen <beau@dflydev.com>
 */
class GeneratorManager
{
    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var Configuration
     */
    protected $siteConfiguration;

    /**
     * @var DataProviderManager
     */
    protected $dataProviderManager;

    /**
     * @var array
     */
    protected $generators = [];

    /**
    * Name : __construct
    *
    * EventDispatcherInterface $eventDispatcher
    * Configuration $siteConfiguration
    * null|DataProviderManager $dataProviderManager
    * @return mixed
    *
    */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        Configuration $siteConfiguration,
        DataProviderManager $dataProviderManager = null
    ) {
        $this->eventDispatcher = $eventDispatcher;
        $this->siteConfiguration = $siteConfiguration;
        $this->dataProviderManager = $dataProviderManager;
    }

    /**
    * Name : registerGenerator
    *
    * mixed $name
    * GeneratorInterface $generator
    * @return void
    *
    */
    public function registerGenerator($name, GeneratorInterface $generator): void
    {
        $this->generators[$name] = $generator;
    }

    /**
    * Name : generate
    *
    * SourceInterface $source
    * SourceSet $sourceSet
    * @return void
    *
    */
    /**
     * @throws \InvalidArgumentException
     */
    public function generate(SourceInterface $source, SourceSet $sourceSet): void
    {
        $data = $source->data();

        $generators = [];
        $isGenerator = $source->isGenerator();
        if ($generatorNames = $data->get('generator')) {
            if (!$isGenerator) {
                $source->setIsGenerator();
            }

            $generatorNames = (array) $generatorNames;

            foreach ($generatorNames as $generatorName) {
                if (!isset($this->generators[$generatorName])) {
                    throw new \InvalidArgumentException(sprintf(
                        "Requested generator '%s' could not be found in %s; was it registered?",
                        $generatorName,
                        $source->relativePathname()
                    ));
                }

                $generators[] = $this->generators[$generatorName];
            }
        } else {
            if ($isGenerator) {
                $source->setIsNotGenerator();
            }
        }

        $targetSources = [$source];

        foreach ($generators as $generator) {
            $newTargetSources = [];
            foreach ($targetSources as $targetSource) {
                foreach ((array) $generator->generate($targetSource) as $generatedSource) {
                    $generatedSource->setIsGenerated();
                    $newTargetSources[] = $generatedSource;
                }
            }
            $targetSources = $newTargetSources;
        }

        foreach ($targetSources as $generatedSource) {
            $sourceSet->mergeSource($generatedSource);
        }
    }

    /**
    * Name : setDataProviderManager
    *
    * null|DataProviderManager $dataProviderManager
    * @return void
    *
    */
    /**
     * Set Data Provider Manager.
     *
     * NOTE: This is a hack because Symfony DiC cannot handle passing Data Provider
     * Manager via constructor injection as some data providers might also rely
     * on formatter. Hurray for circular dependencies. :(
     */
    public function setDataProviderManager(DataProviderManager $dataProviderManager = null): void
    {
        $this->dataProviderManager = $dataProviderManager;
    }
}
