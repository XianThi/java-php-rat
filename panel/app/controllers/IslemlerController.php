<?php

use Phalcon\Flash;
use Phalcon\Session;

class IslemlerController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->tag->setTitle($this->lang->_('index_title'));
    }

    public function indexAction()
    {
        $auth = $this->session->get('auth');
        $rats=new R4t();
        $rats=$rats->find("userid=".$auth['id']);
        $this->view->setvar('rats',$rats);        
    }

    /**
     * Edit the active user profile
     *
     */
    public function profileAction()
    {
        //Get session info
        $auth = $this->session->get('auth');

        //Query the active user
        $user = Users::findFirst($auth['id']);
        if ($user == false) {
            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "index",
                ]
            );
        }

        if (!$this->request->isPost()) {
            $this->tag->setDefault('name', $user->name);
            $this->tag->setDefault('email', $user->email);
        } else {

            $name = $this->request->getPost('name', array('string', 'striptags'));
            $email = $this->request->getPost('email', 'email');

            $user->name = $name;
            $user->email = $email;
            if ($user->save() == false) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            } else {
                $this->flash->success('Your profile information was updated successfully');
            }
        }
    }
}
