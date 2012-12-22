<?php
 namespace SymfonyConsoleModule\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Symfony\Component\Console;

class ConsoleController extends AbstractActionController
{
    /**
     * @var Console\Application
     */
    protected $consoleApplication;

    /**
     * @param Console\Application $application
     */
    public function __construct(Console\Application $application)
    {
        $this->setConsoleApplication($application);
    }

    /**
     * @return Console\Application
     */
    public function getConsoleApplication()
    {
        return $this->consoleApplication;
    }

    /**
     * @param Console\Application $consoleApplication
     */
    public function setConsoleApplication(Console\Application $consoleApplication)
    {
        $this->consoleApplication = $consoleApplication;
    }

    /**
     * Run Symfony console application
     */
    public function allAction()
    {
        $this->getConsoleApplication()->run();
    }
}
