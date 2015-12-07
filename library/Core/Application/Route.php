<?php

namespace Core\Application;

class Route
{

    /**
     * Application config
     * @var array 
     */
    protected $_settings;

    /**
     * Input action
     * @var string 
     */
    protected $_inputAction;

    /**
     * Input route to controller
     * @var string 
     */
    protected $_activeRoute;

    /**
     * Request object
     * @var Request
     */
    protected $_request;

    /**
     * Requested params
     * @var array
     */
    protected $_params = array();

    /**
     * Position of params in URI route from begin
     * @var int
     */
    protected $_paramsPosition = 2;

    /**
     * Init route by application settings and init active routes and Request object
     * @param array $settings
     */
    public function __construct($settings)
    {
        $this->_settings = $settings;
        $this->_initActiveRoute();
        $this->_initRequest();
    }

    /**
     * Init active routes, actions and params
     */
    public function _initActiveRoute()
    {
        $uri = substr($_SERVER['REQUEST_URI'], 1);
        $array = explode('?', $uri);
        $uri = $array[0];
        if ($uri) {
            $routes = explode('/', $uri);
            if (!empty($routes[0])) {
                $this->_activeRoute = $routes[0];
            }
            if (!empty($routes[1])) {
                $this->_inputAction = $routes[1];
            }
            for ($i = $this->_paramsPosition; $i <= count($routes); $i++) {
                if (!empty($routes[$i])) {
                    array_push($this->_params, $routes[$i]);
                }
            }
        } else {
            if (!$uri) {
                $this->_activeRoute = 'main';
            }
        }
    }

    /**
     * Create Request object
     */
    public function _initRequest()
    {
        $this->_request = new Request($this->_activeRoute, $this->_inputAction, $this->_params);
    }

    /**
     * Return Request object
     * @return Request
     */
    public function getRequest()
    {
        return $this->_request;
    }

}
