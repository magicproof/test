<?php

namespace Application\Controllers;

use Core\Application\Controller;
use Application\Models\Table\Video;
use Core\Application\View\Html;

class VideoController extends Controller
{

    /**
     * Display video and subtitles list by path video/info
     */
    public function infoAction()
    {
        $model = new Video();
        $this->view = new Html();
        $this->view->data = $model->getList($name = null, $limit = 10);
    }

    /**
     * Display video list at index action by path video
     */
    public function indexAction()
    {
        $model = new Video();
        $this->view = new Html();
        $this->view->data = $model->getVideoList($limit = 5);
    }

}
