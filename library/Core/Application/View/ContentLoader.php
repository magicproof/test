<?php

namespace Core\Application\View;

class ContentLoader extends Html
{

    /**
     * Set variables for view 
     * @param array $viewVariables
     */
    public function __construct($viewVariables)
    {
        $this->setViewVariables($viewVariables);
    }

    /**
     * Init content for layout
     * @param string $contentViewPath
     * @return string
     */
    public function initContent($contentViewPath)
    {
        ob_start();
        include $contentViewPath;
        $content = ob_get_contents();
        ob_end_clean();
        $this->setContent($content);
        return $content;
    }

    /**
     * Init layout for generate page
     * @param string $layoutPath
     * @return string
     */
    public function initLayout($layoutPath)
    {
        ob_start();
        include APPLICATION_PATH . DS . $layoutPath . '.php';
        $layout = ob_get_contents();
        ob_end_clean();
        return $layout;
    }

    /**
     * Accesses a helper object from within a script.
     * If helper class exist, already created and no arguments passed as second param return current helper object.
     * If arguments passed, call function with same name as a helper class with passed arguments
     * And if class helper not created and exist - created it.
     * If class helper not exist throw Exception
     * @param string $name The helper name.
     * @param array $args The parameters for the helper.
     * @throws Exception
     * @return string The result of the helper output.
     */
    public function __call($name, $args)
    {
        $result = null;
        $helperClass = 'Core\Application\View\Helper\\' . ucfirst($name);
        $helper = $this->getHelper($name);
        if ($helper && !$args) {
            $result = $helper;
        } elseif ($helper && $args) {
            $result = call_user_func_array(
                array($helper, $name), $args
            );
        } elseif (class_exists($helperClass)) {
            $helper = new $helperClass();
            $this->setHelper($name, $helper);
            $result = call_user_func_array(
                array($helper, $name), $args
            );
        } else {
            throw new Exception("$helperClass class does not exist");
        }
        return $result;
    }

    /**
     * Get access to public variable array for view by key as name
     * @param string $name
     * @return mixed|null
     */
    public function __get($name)
    {
        $viewVariables = $this->getViewVariable($name);
        if (isset($viewVariables)) {
            return $viewVariables;
        }
        return null;
    }

}
