<?php

namespace Core\Application;

class View
{

    /**
     * Path to content to view 
     * @var string 
     */
    protected $_contentViewPath;

    /**
     * Layout for view
     * @var string 
     */
    protected $_layoutPath = '';

    /**
     * Set content path for view
     * @param string $controller
     * @param string $action
     * @throws View\Exception
     * @return View
     */
    public function setViewPath($controller, $action)
    {
        $this->_layoutPath = 'layouts' . DS . 'template';
        $content = mb_strtolower($controller . DS . $action);
        $this->_contentViewPath = VIEW_PATH . DS . $content . '.php';
        if (file_exists($this->_contentViewPath)) {
            return $this;
        } else {
            throw new View\Exception("View content file $this->_contentViewPath not found");
        }
    }

    /**
     * Set layout path for view
     * @param string $layout
     */
    public function setLayoutPath($layout)
    {
        $this->_layoutPath = $layout;
    }

    /**
     * Get current layout path for view
     * @return string $layout
     */
    public function getLayoutPath()
    {
        return $this->_layoutPath;
    }

}
