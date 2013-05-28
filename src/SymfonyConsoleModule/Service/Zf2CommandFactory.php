<?php
namespace SymfonyConsoleModule\Service;

use SymfonyConsoleModule\Command\Zf2;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Zf2CommandFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $command = new Zf2();
        $command->setMvcApplication($serviceLocator->get('Application'));
        $command->setRouter($serviceLocator->get('Router'));
        $command->setRequest($serviceLocator->get('Request'));
        return $command;
    }
}
