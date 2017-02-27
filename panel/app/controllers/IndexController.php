<?php


class IndexController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->tag->setTitle($this->lang->_('index_title'));
    }

    public function indexAction()
    {

        if (!$this->request->isPost()) {
            $this->flash->notice($this->lang->_('notice'));
        }
    }
}
