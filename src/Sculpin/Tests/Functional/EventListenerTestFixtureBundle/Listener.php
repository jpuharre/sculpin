<?php

namespace Sculpin\Tests\Functional\EventListenerTestFixtureBundle;

use Sculpin\Core\Event\SourceSetEvent;
use Sculpin\Core\Sculpin;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Listener implements EventSubscriberInterface
{
    protected $outputDir;

    public function __construct($outputDir)
    {
        $this->outputDir = $outputDir;
    }

    public static function getSubscribedEvents(){
        return [
            Sculpin::EVENT_AFTER_RUN => 'createSuccessFile',
        ];
    }

    public function createSuccessFile($event, $eventName){
        file_put_contents($this->outputDir . '/' . $eventName . '.event', $eventName);
    }
}
