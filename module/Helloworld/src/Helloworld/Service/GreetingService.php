<?php

namespace Helloworld\Service;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\Event;

class GreetingService implements EventManagerAwareInterface
{
    private $eventManager;
    private $loggingService;
    
    public function getGreeting()
    {
        //$this->eventManager->addIdentifiers('GreetingService');
        //$this->eventManager->trigger('getGreeting');
        
        $this->loggingService->log('GetGreeting executado!');
        
        if(date('H') <= 11) {
            return "Bom dia, mundo!";
        }elseif(date('H') > 11 && date('H') < 17) {
            return "Ol�, mundo!";
        }else {
            return "Boa noite, mundo!";
        }
    }
    
    public function setLoggingService(LoggingServiceInterface $loggingService)
    {
        $this->loggingService = $loggingService;
    }
    
    public function getLoggingService()
    {
        return $this->loggingService;
    }
    
    public function getEventManager()
    {
        return $this->eventManager;
    }
    
    public function setEventManager(EventManagerInterface $eventManager)
    {
        $this->eventManager = $eventManager;
    }
}