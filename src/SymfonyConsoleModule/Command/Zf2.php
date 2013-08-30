<?php

namespace SymfonyConsoleModule\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Zend\Console\Request;
use Zend\Mvc\Application;
use Zend\Mvc\Router\RouteStackInterface;

class Zf2 extends Command
{
    /**
     * @var RouteStackInterface
     */
    protected $router;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Application
     */
    protected $mvcApplication;

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     * @return Zf2
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return RouteStackInterface
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @param RouteStackInterface $router
     * @return Zf2
     */
    public function setRouter(RouteStackInterface $router)
    {
        $this->router = $router;
        return $this;
    }

    /**
     * @return Application
     */
    public function getMvcApplication()
    {
        return $this->mvcApplication;
    }

    /**
     * @param Application $mvcApplication
     * @return Zf2
     */
    public function setMvcApplication(Application $mvcApplication)
    {
        $this->mvcApplication = $mvcApplication;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this->setName('zf2')
             ->setDescription('Command to run registered ZF2 console commands');
    }

    /**
     * {@inheritDoc}
     */
    public function run(InputInterface $input, OutputInterface $output)
    {
        $this->getRouter()->removeRoute('symfony-console-module');
        $params = $this->getRequest()->getParams();
        $paramsArray = $params->toArray();
        unset($paramsArray[0], $paramsArray['controller'], $paramsArray['action']);
        $params->fromArray(array_values($paramsArray));

        $this->getMvcApplication()->run();
    }
}