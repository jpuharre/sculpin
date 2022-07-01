<?php

class SculpinKernel extends Kernel
\Sculpin\Bundle\SculpinBundle\HttpKernel\AbstractKernel
{
    protected function getAdditionalSculpinBundles(): array
    {
        return [
            \Sculpin\Tests\Functional\EventListenerTestFixtureBundle\EventListenerTestFixtureBundle::class,
        ];
    }
}
