<?php

namespace Application\Controllers;

use Core\Application\Controller;
use Application\Models\Table\Video;
use Core\Application\View\Json;
use Core\Application\View\Html;

class MainController extends Controller
{

    /**
     * Display index action
     */
    public function indexAction()
    {
        $this->view = new Html();
    }

    /**
     * Display new video at path main/new-video
     */
    public function newVideoAction()
    {
        $model = new Video();
        $this->view = new Html();
        $this->view->data = $model->getList($name = "magicproof", $limit = 1);
    }

    /**
     * Json request and response action
     */
    public function exampleAction()
    {
        if ($this->request->isXmlHttpRequest()) {
            $data = $this->request->getParams();
            $this->view = new Json($data);
        }
    }

}
