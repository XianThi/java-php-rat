<?php

/**
 * ContactController
 *
 * Allows to contact the staff using a contact form
 */
class IletisimController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
    $this->tag->setTitle($this->lang->_('index_title'));
    }

    public function indexAction()
    {
        $this->view->form = new ContactForm;
    }

    /**
     * Saves the contact information in the database
     */
    public function sendAction()
    {
        if ($this->request->isPost() != true) {
            return $this->dispatcher->forward(
                [
                    "controller" => "iletisim",
                    "action"     => "index",
                ]
            );
        }

        $form = new ContactForm;
        $contact = new Contact();

        // Validate the form
        $data = $this->request->getPost();
        if (!$form->isValid($data, $contact)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "iletisim",
                    "action"     => "index",
                ]
            );
        }

        if ($contact->save() == false) {
            foreach ($contact->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "iletisim",
                    "action"     => "index",
                ]
            );
        }

        $this->flash->success('Mesajınızı aldım. Bende evet diyorum.');

        return $this->dispatcher->forward(
            [
                "controller" => "index",
                "action"     => "index",
            ]
        );
    }
}
