<?php

namespace Core\Application\View\Helper;

class HeadMeta extends HelperAbstract
{

    /**
     * Default charset
     * @var string 
     */
    protected $_charset = "utf-8";

    /**
     * Default params of 
     * @var array 
     */
    protected $_content = array("width=device-width", "initial-scale=1.0");

    /**
     * Set charset and params of meta tag viewport content if passed arguments
     * @param string $charset
     * @param array $content
     * @return HeadMeta
     */
    public function headMeta($charset = null, $content = array())
    {
        if (isset($charset)) {
            $this->_charset = $charset;
        } elseif ($content) {
            $this->_content = $content;
        }
        return $this;
    }

    /**
     * String representation of main meta tag in html
     * @return string
     */
    public function __toString()
    {
        $content = implode(',', $this->_content);
        $meta = '<meta http-equiv="content-type" content="text/html; charset=' . $this->_charset . '" />'
              . '<meta name="viewport" content="' . $content . '" />';

        return $meta;
    }

}
