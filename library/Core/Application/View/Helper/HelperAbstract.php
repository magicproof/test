<?php

namespace Core\Application\View\Helper;

use Core\Application\View;

abstract class HelperAbstract
{

    /**
     * View object
     * @var View
     */
    public $view = null;

    /**
     * Set the View object
     * @param  View $view
     * @return HelperAbstract
     */
    public function setView(View $view)
    {
        $this->view = $view;
        return $this;
    }

}
