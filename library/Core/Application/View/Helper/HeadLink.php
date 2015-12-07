<?php

namespace Core\Application\View\Helper;

class HeadLink extends HelperAbstract
{

    /**
     * Array of css links
     * @var array
     */
    protected $_links = array();

    /**
     * Single css link
     * @var string
     */
    protected $_settedLink;

    /**
     * Set link in array
     * @param string|array $name
     * @return HeadLink
     */
    public function headLink($name = null)
    {
        if (isset($name) && is_string($name)) {
            $this->append($name);
        } elseif (isset($name) && is_array($name)) {
            $this->_links = array_merge($this->_links, $name);
        }
        return $this;
    }

    /**
     * Set current link first in the links array
     * @param string $name
     * @return HeadLink
     */
    public function prepend($name)
    {
        if (!isset($this->_links[$name])) {
            array_unshift($this->_links, $name);
        }
        return $this;
    }

    /**
     * Append current link in the end of links array(calls as default headLink())
     * @param string $name
     * @return HeadLink
     */
    public function append($name)
    {
        if (!isset($this->_links[$name])) {
            $this->_links[$name] = $name;
        }
        return $this;
    }

    /**
     * Set a single value in the links array
     * @param  string $name
     * @return HeadLink
     */
    public function set($name)
    {
        unset($this->_links);
        $this->_settedLink = $name;
        return $this;
    }

    /**
     * String representation of links in html
     * @return string
     */
    public function __toString()
    {
        $link = '';
        if ($this->_settedLink) {
            $link .= '<link rel="stylesheet" type="text/css" href="' . $this->_settedLink . '" />';
        } elseif ($this->_links) {
            foreach ($this->_links as $value) {
                $link .= '<link rel="stylesheet" type="text/css" href="' . $value . '" />';
            }
        }
        return $link;
    }

}
