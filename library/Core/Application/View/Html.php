<?php

namespace Core\Application\View;

use Core\Application\View;
use Core\Application\View\Helper\HelperAbstract;

class Html extends View
{

    /**
     * Helper array
     * @var array 
     */
    private $_helper;

    /**
     * Html content for view page
     * @var string 
     */
    private $_content;

    /**
     * Html layout for view page
     * @var string 
     */
    private $_layout;

    /**
     * Array of public variables for html view
     * @var array 
     */
    private $_viewVariables;

    /**
     * Generate Html view of application
     */
    public function generate()
    {
        $loader = new ContentLoader($this->_viewVariables);
        $loader->initContent($this->_contentViewPath);
        $this->_layout = $loader->initLayout($this->_layoutPath);
        echo $this->_layout;
    }

    /**
     * Get Helper object by name
     * @param string $name
     * @return HelperAbstract|null
     */
    public function getHelper($name)
    {
        if (isset($this->_helper[$name])) {
            return $this->_helper[$name];
        }
        return null;
    }

    /**
     * Set Helper object to helper array by name
     * @param string $name
     * @param HelperAbstract $helper
     * @return boolean
     */
    public function setHelper($name, HelperAbstract $helper)
    {
        if (!isset($this->_helper[$name])) {
            $this->_helper[$name] = $helper;
            return true;
        }
        return false;
    }

    /**
     * Get html content for layout
     * @return string
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * Set html content for layout
     * @param string $content
     */
    public function setContent($content)
    {
        $this->_content = $content;
    }

    /**
     * Get public variable for view from array by name
     * @param string $name
     * @return mixed|null
     */
    public function getViewVariable($name)
    {
        if (isset($this->_viewVariables[$name])) {
            return $this->_viewVariables[$name];
        }
        return null;
    }

    /**
     * Set view variables array if isset data
     * @param array $data
     * @return boolean
     */
    public function setViewVariables($data)
    {
        if ($data) {
            $this->_viewVariables = $data;
            return true;
        }
        return false;
    }

    /**
     * 
     * @param string $name
     * @param mixed $data
     * @return boolean
     */
    public function setViewVariable($name, $data)
    {
        if (!isset($this->_viewVariables[$name])) {
            $this->_viewVariables[$name] = $data;
            return true;
        }
        return false;
    }

    /**
     * Sets value in viewVariables array if this property is not exist
     * @param string $name
     * @param mixed $value
     * @throws Exception
     */
    public function __set($name, $value)
    {
        if (!strpos($name, ' ') && !isset($this->_viewVariables[$name])) {
            $this->_viewVariables[$name] = $value;
        } else {
            throw new Exception('Setting class members with white spaces is not allowed');
        }
    }

}
