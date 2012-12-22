<?php
namespace SymfonyConsoleModule\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use SymfonyConsoleModule\Controller\ConsoleController;

class ConsoleControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ConsoleController($serviceLocator->getServiceLocator()->get('SymfonyConsoleModule\Console\Application'));
    }
}
