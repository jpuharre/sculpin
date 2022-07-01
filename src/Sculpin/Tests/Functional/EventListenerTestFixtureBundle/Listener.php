<?php

namespace Sculpin\Tests\Functional\EventListenerTestFixtureBundle;

use Sculpin\Core\Event\SourceSetEvent;
use Sculpin\Core\Sculpin;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Listener implements EventSubscriberInterface
{
    public $outputDir;

    function __construct($outputDir)
    {
        $this->outputDir = $outputDir;
    }

    static function getSubscribedEvents(): array
    {
        return [
            Sculpin::EVENT_AFTER_RUN => 'createSuccessFile',
        ];
    }

    function createSuccessFile(SourceSetEvent $event, $eventName): void
    {
        file_put_contents($this->outputDir . '/' . $eventName . '.event', $eventName);
    }
}
