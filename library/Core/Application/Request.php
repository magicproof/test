<?php

namespace Core\Application;

class Request
{

    /**
     * Controllers name
     * @var string 
     */
    protected $_controller;

    /**
     * Action name
     * @var string 
     */
    protected $_action;

    /**
     * Requested params
     * @var array
     */
    protected $_params = array();

    /**
     * Exception object
     * @var Exception 
     */
    protected $_exception;

    /**
     * Set requested controller, action and params
     * @param string $controller
     * @param string $action
     * @param array $params
     */
    public function __construct($controller, $action, $params)
    {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_params = $params;
    }

    /**
     *
     * Get controller name
     * @return string
     */
    public function getController()
    {
        return $this->_controller;
    }

    /**
     * Get action name
     * @return string
     */
    public function getAction()
    {
        return $this->_action;
    }

    /**
     * Check the request is ajax or not
     * @return boolean
     */
    public function isXmlHttpRequest()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
                && (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) 
                && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'));
    }

    /**
     * Get requested data array of params
     * @return array
     */
    public function getParams()
    {
        if (!empty($_REQUEST)) {
            $this->_params = array_merge($this->_params, $_REQUEST);
        }

        return $this->_params;
    }

    /**
     * Get value from params array by key
     * @var int|string $key
     * @return mixed
     */
    public function getParam($key)
    {
        return $this->_params[$key];
    }

    /**
     * Get exception object
     * @return Exception
     */
    public function getException()
    {
        return $this->_exception;
    }

    /**
     * Set exception object
     * @var Exception $exc
     */
    public function setException($exc)
    {
        $this->_exception = $exc;
    }

    /**
     * Set value in params array by key if key is not exist
     * @var int|string $key
     * @var mixed $value
     */
    public function setParam($key, $value)
    {
        if (!isset($this->_params[$key])) {
            $this->_params[$key] = $value;
        }
    }

    /**
     * Unset value from params array by key
     * @var int|string $key
     */
    public function unsetParam($key)
    {
        unset($this->_params[$key]);
    }

}
