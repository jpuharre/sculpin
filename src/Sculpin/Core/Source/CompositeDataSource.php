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
    * Name : CompositeDataSource
    */
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
    * Name : __construct
    *
    * array $dataSources
    * @return mixed
    *
    */
    /**
     * @param DataSourceInterface[] $dataSources
     */
    public function __construct(array $dataSources = [])
    {
        foreach ($dataSources as $dataSource) {
            $this->dataSources[$dataSource->dataSourceId()] = $dataSource;
        }
    }

    /**
    * Name : addDataSource
    *
    * DataSourceInterface $dataSource
    * @return void
    *
    */
    public function addDataSource(DataSourceInterface $dataSource): void
    {
        $this->dataSources[$dataSource->dataSourceId()] = $dataSource;
    }

    /**
    * Name : dataSources
    *
    *  
    * @return array
    *
    */
    /**
     * Get the data sources that this source is composed of.
     *
     * @return DataSourceInterface[]
     */
    public function dataSources(): array
    {
        return $this->dataSources;
    }

    /**
    * Name : dataSourceId
    *
    *  
    * @return string
    *
    */
    /**
     * {@inheritdoc}
     */
    public function dataSourceId(): string
    {
        return 'CompositeDataSource('.implode(',', array_map(function (DataSourceInterface $dataSource) {
            return $dataSource->dataSourceId();
        }, $this->dataSources));
    }

    /**
    * Name : refresh
    *
    * SourceSet $sourceSet
    * @return void
    *
    */
    /**
     * {@inheritdoc}
     */
    public function refresh(SourceSet $sourceSet): void
    {
        foreach ($this->dataSources as $dataSource) {
            $dataSource->refresh($sourceSet);
        }
    }
}
