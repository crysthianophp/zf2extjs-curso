<?php

namespace SONUser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use SONUser\Form\User as UserForm;
use SONUser\Form\UserFilter;

class UsersController extends AbstractActionController 
{
    /**
     *
     * @var $em \Doctrine\ORM\EntityManager
     */
    private $em;
    private $form;
    
    public function __construct()
    {
        $this->form = new UserForm();
    }
    
    public function indexAction()
    {
        $list = $this->getEm()
                     ->getRepository('SONUser\Entity\User')
                     ->findAll();
        
        return new ViewModel(array(
            'data' => $list
        ));
    }
    
    public function newAction()
    {
        $form = $this->form;
        $form->setInputFilter(new UserFilter());
        
        $request = $this->getRequest();
        
        if($request->isPost()) {
            $form->setData($request->getPost());
            if($form->isValid()) {
                //$data = $form->getData();
                
                $userService = $this->getServiceLocator()->get('SONUser\Service\User');
                $result = $userService->insert($form->getData());
                
                if($result) {
                    return $this->redirect()->toRoute('sonuser-admin', array('controller' => 'users'));
                }
                
            }
        }
        return new ViewModel(array('form' => $form));
    }
    
    public function editAction()
    {
        $form = $this->form;
        $form->setInputFilter(new UserFilter());
        
        $request = $this->getRequest();
        
        
        $repository = $this->getEm()->getRepository('SONUser\Entity\User');
        $entity = $repository->find($this->params()->fromRoute('id', 0));
        
        if($entity) {
            $form->setData($entity->toArray());
        }
        
        if($request->isPost()) {
            $form->setData($request->getPost());
            if($form->isValid()) {
                $userService = $this->getServiceLocator()->get('SONUser\Service\User');
                $result = $userService->update($form->getData());
                
                if($result) {
                    return $this->redirect()->toRoute('sonuser-admin', array('controller' => 'users'));
                }
            }
        }
        
        return new ViewModel(array('form' => $form));
    }
    
    public function deleteAction()
    {
        $userService = $this->getServiceLocator()->get('SONUser\Service\User');
        if($userService->delete($this->params()->fromRoute('id', 0))) {
            return $this->redirect()->toRoute('sonuser-admin', array('controller' => 'users'));
        }
    }
    
    /**
     * @return \Doctrine\ORM\EntityManager
     */
    private function getEm()
    {
        return $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }
}
