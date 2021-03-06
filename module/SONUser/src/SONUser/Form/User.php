<?php

namespace SONUser\Form;

use Zend\Form\Form;

class User extends Form 
{
    public function __construct()
    {
        parent::__construct('user');
        
        $this->setAttribute('method', 'post');
        
        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);
        
        $nome = new \Zend\Form\Element\Text('nome');
        $nome->setLabel('Nome:');
        $this->add($nome);
        
        $email = new \Zend\Form\Element\Email('email');
        $email->setLabel('Email:');
        $this->add($email);
        
        $password = new \Zend\Form\Element\Password('password');
        $password->setLabel('Senha:');
        $this->add($password);
        
        $csrf = new \Zend\Form\Element\Csrf('security');
        $this->add($csrf);
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn btn-success'
            )
        ));
    }
}
