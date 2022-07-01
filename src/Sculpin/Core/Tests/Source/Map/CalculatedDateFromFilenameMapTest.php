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

namespace Sculpin\Core\Tests\Source\Map;

use Dflydev\DotAccessConfiguration\Configuration as Data;
use PHPUnit\Framework\TestCase;
use Sculpin\Core\Source\Map\CalculatedDateFromFilenameMap;
use Sculpin\Core\Source\MemorySource;

    /**
    * Name : CalculatedDateFromFilenameMapTest
    */
    class CalculatedDateFromFilenameMapTest extends TestCase
{
    /**
     * @var CalculatedDateFromFilenameMap
     */
    private $map;

    /**
    * Name : setUp
    *
    *  
    * @return void
    *
    */
    protected function setUp(): void
    {
        $this->map = new CalculatedDateFromFilenameMap();
    }

    /**
    * Name : itShouldNotModifyAnExistingCalculatedDate
    *
    *  
    * @return mixed
    *
    */
    /** @test */
    public function itShouldNotModifyAnExistingCalculatedDate()
    {
        $source = $this->getSourceWithCalculatedDate($timestamp = 123456);

        $this->map->process($source);

        $this->assertEquals($timestamp, $source->data()->get('calculated_date'));
    }

    /**
    * Name : itShouldSetTheCalculatedDateIfFound
    *
    *  
    * @return mixed
    *
    */
    /** @test */
    public function itShouldSetTheCalculatedDateIfFound()
    {
        $source = $this->getSourceWithoutCalculatedDateAndPathname("2013-12-12-sculpin-is-great.markdown");

        $this->map->process($source);

        $this->assertEquals(strtotime("2013-12-12"), $source->data()->get('calculated_date'));
    }

    /**
    * Name : itShouldIncludeTheTimeIfFound
    *
    *  
    * @return mixed
    *
    */
    /** @test */
    public function itShouldIncludeTheTimeIfFound()
    {
        $source = $this->getSourceWithoutCalculatedDateAndPathname("2013-12-12-220212-sculpin-is-great.markdown");

        $this->map->process($source);

        $this->assertEquals(strtotime("2013-12-12 22:02:12"), $source->data()->get('calculated_date'));
    }

    /**
    * Name : itShouldIgnoreTheTimeIfItsProbablyNotATime
    *
    *  
    * @return mixed
    *
    */
    /** @test */
    public function itShouldIgnoreTheTimeIfItsProbablyNotATime()
    {
        $source = $this->getSourceWithoutCalculatedDateAndPathname(
            "2013-12-12-10-reasons-why-sculpin-is-great.markdown"
        );

        $this->map->process($source);

        $this->assertEquals(strtotime("2013-12-12"), $source->data()->get('calculated_date'));
    }

    /**
    * Name : getSourceWithCalculatedDate
    *
    * mixed $timestamp
    * @return mixed
    *
    */
    protected function getSourceWithCalculatedDate($timestamp)
    {
        return new MemorySource(
            uniqid(),
            new Data(['calculated_date' => $timestamp]),
            "contents",
            "formatted contents",
            __FILE__,
            __FILE__,
            new \SplFileInfo(__FILE__),
            false,
            false,
            false
        );
    }

    /**
    * Name : getSourceWithoutCalculatedDateAndPathname
    *
    * mixed $path
    * @return mixed
    *
    */
    protected function getSourceWithoutCalculatedDateAndPathname($path)
    {
        return new MemorySource(
            uniqid(),
            new Data(),
            "contents",
            "formatted contents",
            $path,
            $path,
            new \SplFileInfo(__FILE__),
            false,
            false,
            false
        );
    }
}
