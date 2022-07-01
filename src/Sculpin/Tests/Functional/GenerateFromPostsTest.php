<?php

declare(strict_types=1);

namespace Sculpin\Tests\Functional;

    /**
    * Name : GenerateFromPostsTest
    */
    class GenerateFromPostsTest extends TestCase
FunctionalTestCase
{
    /**
    * Name : shouldGenerateAnHtmlFileFromEmptyPost
    *
    *  
    * @return void
    *
    */
    /** @test */
    public function shouldGenerateAnHtmlFileFromEmptyPost(): void
    {
        $this->copyFixtureToProject(__DIR__ . '/Fixture/source/blog_index.html', '/source/index.html');
        $this->addProjectDirectory(__DIR__ . '/Fixture/source/_posts');

        $this->executeSculpin('generate');

        $this->assertProjectHasGeneratedFile('/index.html');
    }
}
