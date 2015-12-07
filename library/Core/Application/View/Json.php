<?php

namespace Core\Application\View;

use Core\Application\View;

class Json extends View
{

    /**
     * Data for JSON response
     * @var mixed 
     */
    protected $_data;

    /**
     * Set view by argument data if passed
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->_data = $data;
    }

    /**
     * Generate Json response for ajax request
     */
    public function generate()
    {
        echo json_encode($this->_data);
    }

}
