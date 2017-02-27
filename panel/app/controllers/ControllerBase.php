<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    protected function initialize()
    {
        $this->tag->prependTitle('r4t | ');
        $lang=$this->translation;
        $this->di->setShared('lang', $lang);
        $this->view->t    = $lang;
        $this->view->setTemplateAfter('main');
    }
    

}
