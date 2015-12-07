<?php

namespace Core\Application\View\Helper;

class HeadTitle extends HelperAbstract
{

    /**
     * Title name
     * @var string 
     */
    protected $_title;

    /**
     * Set title
     * @param string $name
     */
    public function headTitle($name)
    {
        $this->_title = $name;
    }

    /**
     * String representation of title in html
     * @return string
     */
    public function __toString()
    {
        return "<title>$this->_title</title>";
    }

}
