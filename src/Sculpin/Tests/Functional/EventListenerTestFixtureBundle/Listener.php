<?php

namespace Sculpin\Tests\Functional\EventListenerTestFixtureBundle;

use Sculpin\Core\Event\SourceSetEvent;
use Sculpin\Core\Sculpin;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

    /**
    * Name : Listener
    */
    class Listener implements EventSubscriberInterface
{
    protected $outputDir;

    /**
    * Name : __construct
    *
    * mixed $outputDir
    * @return mixed
    *
    */
    public function __construct($outputDir)
    {
        $this->outputDir = $outputDir;
    }

    /**
    * Name : getSubscribedEvents
    *
    *  
    * @return array
    *
    */
    public static function getSubscribedEvents(): array
    {
        return [
            Sculpin::EVENT_AFTER_RUN => 'createSuccessFile',
        ];
    }

    /**
    * Name : createSuccessFile
    *
    * SourceSetEvent $event
    * mixed $eventName
    * @return void
    *
    */
    public function createSuccessFile(SourceSetEvent $event, $eventName): void
    {
        file_put_contents($this->outputDir . '/' . $eventName . '.event', $eventName);
    }
}
