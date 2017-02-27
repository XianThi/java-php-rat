<?php

class HakkindaController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->tag->setTitle($this->lang->_('index_title'));
    }

    public function indexAction()
    {
    }
}
