<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class RegisterForm extends Form
{

    public function initialize($entity = null, $options = null)
    {
        // Name
        $name = new Text('name');
        $name->setLabel('İsim Soyisim');
        $name->setFilters(array('striptags', 'string'));
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'İsim alanı gerekli.'
            ))
        ));
        $this->add($name);

        // Name
        $name = new Text('username');
        $name->setLabel('Kullanıcı Adı');
        $name->setFilters(array('alpha'));
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'Kullanıcı adı gerekli.'
            ))
        ));
        $this->add($name);

        // Email
        $email = new Text('email');
        $email->setLabel('E-Mail');
        $email->setFilters('email');
        $email->addValidators(array(
            new PresenceOf(array(
                'message' => 'E-mail gerekli'
            )),
            new Email(array(
                'message' => 'E-mail adresi geçersiz.'
            ))
        ));
        $this->add($email);

        // Password
        $password = new Password('password');
        $password->setLabel('Şifre');
        $password->addValidators(array(
            new PresenceOf(array(
                'message' => 'Şifre gerekli.'
            ))
        ));
        $this->add($password);

        // Confirm Password
        $repeatPassword = new Password('repeatPassword');
        $repeatPassword->setLabel('Şifre Tekrar');
        $repeatPassword->addValidators(array(
            new PresenceOf(array(
                'message' => 'Şifre doğrulaması gerekli.'
            ))
        ));
        $this->add($repeatPassword);
    }
}