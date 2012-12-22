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
     * Expected to return \Zend\ServiceManager\Config object or array to seed
     * such an object.
     *
     * @return array|\Zend\ServiceManager\Config
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
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'SymfonyConsoleModule\Console\Application' => 'SymfonyConsoleModule\Service\ConsoleApplicationFactory',
            ),
        );
    }

    /**
     * Return an array for passing to Zend\Loader\AutoloaderFactory.
     *
     * @return array
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
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
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
                                    'action'     => 'all'
                                )
                            )
                        ),
                    )
                )
            ),
        );
    }
}