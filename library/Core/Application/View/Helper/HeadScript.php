<?php

namespace Core\Application\View\Helper;

class HeadScript extends HelperAbstract
{

    /**
     * Array of scripts
     * @var array
     */
    protected $_scripts = array();

    /**
     * Single css script
     * @var string
     */
    protected $_settedScript;

    /**
     * Set scripts in array
     * @param string|array $name
     * @return HeadScript
     */
    public function headScript($name = null)
    {
        if (isset($name) && is_string($name)) {
            $this->append($name);
        } elseif (isset($name) && is_array($name)) {
            $this->_scripts = array_merge($this->_scripts, $name);
        }
        return $this;
    }

    /**
     * Set current script first in the script array
     * @param string $name
     * @return HeadScript
     */
    public function prepend($name)
    {
        if (!isset($this->_scripts[$name])) {
            array_unshift($this->_scripts, $name);
        }
        return $this;
    }

    /**
     * Append current script in the end of script array(calls as default headScript())
     * @param string $name
     * @return HeadScript
     */
    public function append($name)
    {
        if (!isset($this->_scripts[$name])) {
            $this->_scripts[$name] = $name;
        }
        return $this;
    }

    /**
     * Set a single value in the script array
     * @param  string $value
     * @return HeadScript
     */
    public function set($value)
    {
        unset($this->_scripts);
        $this->_settedScript = $value;

        return $this;
    }

    /**
     * String representation of scripts in html
     * @return string
     */
    public function __toString()
    {
        $script = '';
        if ($this->_settedScript) {
            $script .= '<script src="' . $this->_settedScript . '" type="text/javascript"></script>';
        } elseif ($this->_scripts) {
            foreach ($this->_scripts as $value) {
                $script .= '<script src="' . $value . '" type="text/javascript"></script>';
            }
        }
        return $script;
    }

}
