<?php

namespace Gh05tPL\SimpleInfluxDbClientBundle;

use Gh05tPL\SimpleInfluxDbClientBundle\DependencyInjection\SimpleInfluxDbClientExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SimpleInfluxDbClientBundle extends Bundle
{
    public function getContainerExtension(): ExtensionInterface|null
    {
        return new SimpleInfluxDbClientExtension();
    }
}