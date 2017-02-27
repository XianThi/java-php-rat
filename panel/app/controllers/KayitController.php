<?php

/**
 * SessionController
 *
 * Allows to register new users
 */
class KayitController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->tag->setTitle($this->lang->_('index_title'));
    }

    /**
     * Action to register a new user
     */
    public function indexAction()
    {
        $form = new RegisterForm;

        if ($this->request->isPost()) {

            $name = $this->request->getPost('name', array('string', 'striptags'));
            $username = $this->request->getPost('username', 'alphanum');
            $email = $this->request->getPost('email', 'email');
            $password = $this->request->getPost('password');
            $repeatPassword = $this->request->getPost('repeatPassword');
            $generator = new RandomStringGenerator();
            $tokenLength = 32;
            $token = $generator->generate($tokenLength);
            if ($password != $repeatPassword) {
                $this->flash->error('Şifreler eşleşmiyor.');
                return false;
            }

            $user = new Users();
            $user->username = $username;
            $user->password = sha1($password);
            $user->name = $name;
            $user->email = $email;
            $user->created_at = new Phalcon\Db\RawValue('now()');
            $user->active = 'Y';
            $user->auth = 0;
            $user->token=$token;
            if ($user->save() == false) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            } else {
                $this->tag->setDefault('email', '');
                $this->tag->setDefault('password', '');
                $this->flash->success('Kayıt başarıyla oluşturuldu.');

                return $this->dispatcher->forward(
                    [
                        "controller" => "oturum",
                        "action"     => "index",
                    ]
                );
            }
        }

        $this->view->form = $form;
    }
}
