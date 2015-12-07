<?php

namespace Application\Controllers;

use Core\Application\Controller;
use Core\Application\View\Html;

class ErrorController extends Controller
{

    /**
     * Display 404 error message
     */
    public function IndexAction()
    {
        $this->view = new Html();
        $this->view->exception = $this->request->getParam('appException');
        $this->request->unsetParam('appException');
        $this->view->params = $this->request->getParams();
    }

}
