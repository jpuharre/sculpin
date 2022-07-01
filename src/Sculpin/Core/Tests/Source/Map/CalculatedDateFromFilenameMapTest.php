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

class CalculatedDateFromFilenameMapTest extends TestCase
{
    /**
     * @var CalculatedDateFromFilenameMap
     */
    public $map;

    function setUp(): void
    {
        $this->map = new CalculatedDateFromFilenameMap();
    }

    /** @test */
    function itShouldNotModifyAnExistingCalculatedDate()
    {
        $source = $this->getSourceWithCalculatedDate($timestamp = 123456);

        $this->map->process($source);

        $this->assertEquals($timestamp, $source->data()->get('calculated_date'));
    }

    /** @test */
    function itShouldSetTheCalculatedDateIfFound()
    {
        $source = $this->getSourceWithoutCalculatedDateAndPathname("2013-12-12-sculpin-is-great.markdown");

        $this->map->process($source);

        $this->assertEquals(strtotime("2013-12-12"), $source->data()->get('calculated_date'));
    }

    /** @test */
    function itShouldIncludeTheTimeIfFound()
    {
        $source = $this->getSourceWithoutCalculatedDateAndPathname("2013-12-12-220212-sculpin-is-great.markdown");

        $this->map->process($source);

        $this->assertEquals(strtotime("2013-12-12 22:02:12"), $source->data()->get('calculated_date'));
    }

    /** @test */
    function itShouldIgnoreTheTimeIfItsProbablyNotATime()
    {
        $source = $this->getSourceWithoutCalculatedDateAndPathname(
            "2013-12-12-10-reasons-why-sculpin-is-great.markdown"
        );

        $this->map->process($source);

        $this->assertEquals(strtotime("2013-12-12"), $source->data()->get('calculated_date'));
    }

    function getSourceWithCalculatedDate($timestamp)
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

    function getSourceWithoutCalculatedDateAndPathname($path)
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
