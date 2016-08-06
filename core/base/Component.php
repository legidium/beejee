<?php
namespace core\base;

class Component
{
    /**
     * @var Application
     */
    protected $_application;

    public function __construct($config = [])
    {
        $this->configure($config);
        $this->init();
    }

    /**
     * Initialize the component.
     */
    public function init()
    {

    }

    /**
     * Get the application.
     * @return Application;
     */
    public function getApplication()
    {
        return $this->_application;
    }

    /**
     * Set the application.
     * @param $application Application
     */
    public function setApplication($application)
    {
        $this->_application = $application;
    }

    /**
     * Configure the component.
     * @param array $config
     */
    protected function configure($config = [])
    {

    }
}
