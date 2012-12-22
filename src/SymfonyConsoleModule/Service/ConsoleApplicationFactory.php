<?php
namespace SymfonyConsoleModule\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Symfony\Component\Console;

class ConsoleApplicationFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @throws \RuntimeException
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');

        if(!isset($config['console'])) {
            throw new \RuntimeException('No console configuration defined');
        }

        $application = new Console\Application();
        if (isset($config['console']['name'])) {
            $application->setName($config['console']['name']);
        }

        if (isset($config['console']['version'])) {
            $application->setVersion($config['console']['version']);
        }

        $commands = isset($config['console']['commands']) ? $config['console']['commands'] : array();
        foreach($commands as $command) {
            $application->add($serviceLocator->get($command));
        }
        return $application;
    }
}
