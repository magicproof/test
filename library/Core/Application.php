<?php

namespace Core;

require_once APPLICATION_PATH . DIRECTORY_SEPARATOR . 'Bootstrap.php';

use Core\Application\Route;
use Core\Application\Controller;
use Core\Application\Request;
use Application\BootStrap;

class Application
{
    private $_magic = 0;

    /**
     *  Constants of Application
     */
    const DEFAULT_ACTION = 'index';
    const ACTION = 'Action';
    const DEFAULT_ERROR_CONTROLLER = 'Error';

    /**
     * Application config
     * @var array
     */
    protected $_settings;

    /**
     * Request object
     * @var Request
     */
    protected $_request;

    /**
     * Route object
     * @var Route
     */
    protected $_route;

    /**
     * Action path name for view content
     * @var string 
     */
    protected $_actionPath;

    /**
     * Application config
     * @param array $settings
     */
    public function __construct($settings)
    {
        $this->_settings = $settings;
        $this->_runBootStrap();
    }

    /**
     * Run application
     */
    public function run()
    {
        $this->_route = new Route($this->_settings);
        $this->_request = $this->_route->getRequest();
        try {
            $controller = $this->_request->getController();
            $action = $this->_request->getAction();
            $this->_actionPath = $action;
            preg_match("/-[a-z]/", $action, $matched);
            if ($matched) {
                $string = str_replace('-', '', $matched[0]);
                $action = preg_replace("/-[a-z]/", strtoupper($string), $action);
            }
            $methodName = $action . self::ACTION;
            $controllerNameSpace = $this->getControllerNameSpace($controller);
            if (class_exists($controllerNameSpace)) {
                if (!$action) {
                    $action = self::DEFAULT_ACTION;
                    $this->_actionPath = $action;
                } elseif (!method_exists($controllerNameSpace, $methodName)) {
                    throw new Controller\Action\Exception("Action " . $action . " not found");
                }
            } else {
                throw new Controller\Exception("Controller " . $controller . " not found");
            }
            $this->_launchPage($controller, $action);
        } catch (Application\Exception $exc) {
            $controller = self::DEFAULT_ERROR_CONTROLLER;
            $action = self::DEFAULT_ACTION;
            $this->_actionPath = $action;
            $this->_request->setParam('appException', $exc);
            $this->_setHeader();
            $this->_launchPage($controller, $action);
        }
    }

    /**
     * Run bootstrap for this application
     */
    protected function _runBootStrap()
    {
        $bootStrap = new BootStrap();
        $bootStrap->run();
    }

    /**
     * Set headers for 404 Error
     */
    protected function _setHeader()
    {
        header("Status 404: Not Found");
        header("HTTP/1.1 404 Not Found");
    }

    /**
     * Create controller, then start action and finally render page
     * @param string $controllerName
     * @param string $actionName
     */
    protected function _launchPage($controllerName, $actionName)
    {
        $controllerNameSpace = $this->getControllerNameSpace($controllerName);
        $controller = new $controllerNameSpace($this->_request);
        $methodName = $actionName . self::ACTION;
        $controller->$methodName();
        $view = $controller->view;
        if ($view) {
            $view->setViewPath($controllerName, $this->_actionPath)
                ->generate();
        }
    }

    /**
     * Get namespace of controller
     * @param string controller
     * @return string
     */
    public function getControllerNameSpace($controller)
    {
        return sprintf('Application\Controllers\%sController', ucfirst($controller));
    }

}
