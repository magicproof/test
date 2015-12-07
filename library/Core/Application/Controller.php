<?php

namespace Core\Application;

abstract class Controller
{

    /**
     * Object of View class
     * @var View
     */
    public $view;

    /**
     * Object of Request class
     * @var Request 
     */
    public $request;

    /**
     * Init controllers by Request object
     * @param Request $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

}
