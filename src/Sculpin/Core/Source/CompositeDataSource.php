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
    private $dataSources = [];

    /**
     * @param DataSourceInterface[] $dataSources
     */
    public function __construct($dataSources = [])
    {
        foreach ($dataSources as $dataSource) {
            $this->dataSources[$dataSource->dataSourceId()] = $dataSource;
        }
    }

    public function addDataSource($dataSource){
        $this->dataSources[$dataSource->dataSourceId()] = $dataSource;
    }

    /**
     * Get the data sources that this source is composed of.
     *
     * @return DataSourceInterface[]
     */
    public function dataSources(){
        return $this->dataSources;
    }

    /**
     * {@inheritdoc}
     */
    public function dataSourceId(){
        return 'CompositeDataSource('.implode(',', array_map(function ($dataSource) {
            return $dataSource->dataSourceId();
        }, $this->dataSources));
    }

    /**
     * {@inheritdoc}
     */
    public function refresh($sourceSet){
        foreach ($this->dataSources as $dataSource) {
            $dataSource->refresh($sourceSet);
        }
    }
}
