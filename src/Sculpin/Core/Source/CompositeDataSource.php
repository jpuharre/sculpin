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

/**
 * @author Beau Simensen <beau@dflydev.com>
 */
class CompositeDataSource implements DataSourceInterface
{
    /**
     * @var DataSourceInterface[]
     */
    public $dataSources = [];

    /**
     * @param DataSourceInterface[] $dataSources
     */
    function __construct(array $dataSources = [])
    {
        foreach ($dataSources as $dataSource) {
            $this->dataSources[$dataSource->dataSourceId()] = $dataSource;
        }
    }

    function addDataSource(DataSourceInterface $dataSource): void
    {
        $this->dataSources[$dataSource->dataSourceId()] = $dataSource;
    }

    /**
     * Get the data sources that this source is composed of.
     *
     * @return DataSourceInterface[]
     */
    function dataSources(): array
    {
        return $this->dataSources;
    }

    /**
     * {@inheritdoc}
     */
    function dataSourceId(): string
    {
        return 'CompositeDataSource('.implode(',', array_map(function (DataSourceInterface $dataSource) {
            return $dataSource->dataSourceId();
        }, $this->dataSources));
    }

    /**
     * {@inheritdoc}
     */
    function refresh(SourceSet $sourceSet): void
    {
        foreach ($this->dataSources as $dataSource) {
            $dataSource->refresh($sourceSet);
        }
    }
}
