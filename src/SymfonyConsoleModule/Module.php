<?php
namespace SymfonyConsoleModule;

use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Loader\StandardAutoloader;
use Zend\Loader\AutoloaderFactory;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements
    ControllerProviderInterface,
    ServiceProviderInterface,
    AutoloaderProviderInterface,
    ConfigProviderInterface
{

    /**
     * {@inheritDoc}
     */
    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'SymfonyConsoleModule\Controller\Console' => 'SymfonyConsoleModule\Service\ConsoleControllerFactory'
            ),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'SymfonyConsoleModule\Console\Application' => 'SymfonyConsoleModule\Service\ConsoleApplicationFactory',
                'SymfonyConsoleModule\Command\Zf2' => 'SymfonyConsoleModule\Service\Zf2CommandFactory',
            ),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getAutoloaderConfig()
    {
        return array(
            AutoloaderFactory::STANDARD_AUTOLOADER => array(
                StandardAutoloader::LOAD_NS => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return array(
            'console' => array(
                'router' => array(
                    'routes' => array(
                        'symfony-console-module' => array(
                            'type'    => 'catchall',
                            'options' => array(
                                'defaults' => array(
                                    'controller' => 'SymfonyConsoleModule\Controller\Console',
                                    'action'     => 'all',
                                ),
                            ),
                        ),
                    ),
                ),
                'commands' => array(
                    'SymfonyConsoleModule\Command\Zf2'
                ),
            ),
        );
    }
}