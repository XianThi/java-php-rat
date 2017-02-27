<?php

class AdminController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle($this->lang->_('index_title'));
        parent::initialize();
    }

    public function indexAction()
    {
    }
}
