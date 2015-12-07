<?php

namespace Core\Application\View\Helper;

class Doctype extends HelperAbstract
{

    /**
     * doctype constants
     */
    const XHTML11 = 'XHTML11';
    const XHTML1_STRICT = 'XHTML1_STRICT';
    const XHTML1_TRANSITIONAL = 'XHTML1_TRANSITIONAL';
    const XHTML1_FRAMESET = 'XHTML1_FRAMESET';
    const XHTML1_RDFA = 'XHTML1_RDFA';
    const XHTML1_RDFA11 = 'XHTML1_RDFA11';
    const XHTML_BASIC1 = 'XHTML_BASIC1';
    const XHTML5 = 'XHTML5';
    const HTML4_STRICT = 'HTML4_STRICT';
    const HTML4_LOOSE = 'HTML4_LOOSE';
    const HTML4_FRAMESET = 'HTML4_FRAMESET';
    const HTML5 = 'HTML5';
    const CUSTOM_XHTML = 'CUSTOM_XHTML';
    const CUSTOM = 'CUSTOM';

    /**
     * Default doctype
     * @var string
     */
    protected $_defaultDoctype = self::HTML5;

    /**
     * Array of doctype
     * @var array
     */
    protected $_doctypes;

    /**
     * Current doctype for view
     * @var string
     */
    protected $_doctype;

    /**
     * Set default doctype array
     */
    public function __construct()
    {
        $this->_doctypes = array(
            self::XHTML11 => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
            self::XHTML1_STRICT => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
            self::XHTML1_TRANSITIONAL => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
            self::XHTML1_FRAMESET => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
            self::XHTML1_RDFA => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">',
            self::XHTML1_RDFA11 => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.1//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-2.dtd">',
            self::XHTML_BASIC1 => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.0//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd">',
            self::XHTML5 => '<!DOCTYPE html>',
            self::HTML4_STRICT => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',
            self::HTML4_LOOSE => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
            self::HTML4_FRAMESET => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">',
            self::HTML5 => '<!DOCTYPE html>',
        );
    }

    /**
     * Set doctype
     *
     * @param  string $doctype
     * @return Doctype
     */
    public function doctype($doctype = null)
    {
        switch ($doctype) {
            case self::XHTML11:
            case self::XHTML1_STRICT:
            case self::XHTML1_TRANSITIONAL:
            case self::XHTML1_FRAMESET:
            case self::XHTML_BASIC1:
            case self::XHTML1_RDFA:
            case self::XHTML1_RDFA11:
            case self::XHTML5:
            case self::HTML4_STRICT:
            case self::HTML4_LOOSE:
            case self::HTML4_FRAMESET:
            case self::HTML5:
                $this->setDoctype($doctype);
                break;
            default:
                $this->setDoctype($this->_defaultDoctype);
                break;
        }
        return $this;
    }

    /**
     * Set current doctype for view
     * @param string $doctype
     */
    public function setDoctype($doctype)
    {
        $this->_doctype = $this->_doctypes[$doctype];
    }

    /**
     * Add custom doctype
     * @param  string $key
     * @param  string $doctype
     * @return Doctype
     */
    public function setCustomDoctype($key, $doctype)
    {
        if (!isset($this->_doctypes[$key])) {
            $this->_doctypes[$key] = $doctype;
            $this->_doctype = $doctype;
        }
        return $this;
    }

    /**
     * String representation of doctype
     * @return string
     */
    public function __toString()
    {
        return $this->_doctype;
    }

    /**
     * Get doctypes array
     *
     * @return array
     */
    public function getDoctypes()
    {
        return $this->_doctypes;
    }

}
