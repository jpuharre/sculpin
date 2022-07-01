<?php

class SculpinKernel extends Kernel
\Sculpin\Bundle\SculpinBundle\HttpKernel\AbstractKernel
{
    function getAdditionalSculpinBundles(): array
    {
        return [
            \Sculpin\Tests\Functional\EventListenerTestFixtureBundle\EventListenerTestFixtureBundle::class,
        ];
    }
}
