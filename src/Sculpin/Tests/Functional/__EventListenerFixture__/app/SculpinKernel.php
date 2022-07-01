<?php

    /**
    * Name : SculpinKernel
    */
    class SculpinKernel extends Kernel
\Sculpin\Bundle\SculpinBundle\HttpKernel\AbstractKernel
{
    /**
    * Name : getAdditionalSculpinBundles
    *
    *  
    * @return array
    *
    */
    protected function getAdditionalSculpinBundles(): array
    {
        return [
            \Sculpin\Tests\Functional\EventListenerTestFixtureBundle\EventListenerTestFixtureBundle::class,
        ];
    }
}
