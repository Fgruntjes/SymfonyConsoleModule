<?php
namespace SymfonyConsoleModule\Service;

use Zend\ServiceManager\FactoryInterface;
use Symfony\Component\Console\Helper\HelperSet;
use Zend\ServiceManager\ServiceLocatorInterface;
use Symfony\Component\Console;

class ConsoleApplicationFactory implements FactoryInterface
{
    /**
     * @var \Zend\EventManager\EventManagerInterface
     */
    protected $events;

    /**
     * @param  ServiceLocatorInterface                  $sm
     * @return \Zend\EventManager\EventManagerInterface
     */
    public function getEventManager(ServiceLocatorInterface $sm)
    {
        if (null === $this->events) {
            /* @var $events \Zend\EventManager\EventManagerInterface */
            $events = $sm->get('EventManager');
            $events->addIdentifiers(array(
                __CLASS__,
                'console',
                'doctrine'
            ));

            $this->events = $events;
        }

        return $this->events;
    }

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

        $this->getEventManager($serviceLocator)->trigger('load.post', $application, array('ServiceManager' => $serviceLocator));
        $this->getEventManager($serviceLocator)->trigger('loadCli.post', $application, array('ServiceManager' => $serviceLocator));

        return $application;
    }
}
