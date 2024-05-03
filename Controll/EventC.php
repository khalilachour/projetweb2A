<?php
require_once 'Model/Event.php';

class EventC {
    private $eventModel;

    public function __construct(PDO $pdo) {
        $this->eventModel = new Event($pdo);
    }

    public function createEvent() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $eventData = $this->validateEventData($_POST);

           
            $this->eventModel->createEvent($eventData);

            
            header('Location: index.php?action=viewEvent');
            exit();
        }

        include('View/create_event.php');
    }

    public function viewEvent($eventId) {
       
        $event = $this->eventModel->getEvent($eventId);

       
        include('View/view_event.php');
    }

    public function updateEvent($eventId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $eventData = $this->validateEventData($_POST);

            
            $this->eventModel->updateEvent($eventId, $eventData);

           
            header('Location: index.php?action=viewEvent&eventId=' . $eventId);
            exit();
        }

        
        $event = $this->eventModel->getEvent($eventId);

        
        include('View/update_event.php');
    }

    public function deleteEvent($eventId) {
        
        $eventId = $this->validateEventId($eventId);

        
        $this->eventModel->deleteEvent($eventId);

        
        header('Location: index.php');
        exit();
    }

    public function searchEvent($eventName) {
        
        $eventName = $this->validateInput($eventName);

        
        $events = $this->eventModel->searchEventByName($eventName);

       
        include('View/search_event.php');

       
        return $events;
    }

    public function readAll() {
        
        $events = $this->eventModel->getAllEvents();

       
        return $events;
    }

    
    private function validateEventData($data) {
        $validatedData = [];
        foreach ($data as $key => $value) {
            $validatedData[$key] = $this->validateInput($value);
        }
        return $validatedData;
    }

    
    private function validateEventId($eventId) {
        
        return $this->validateInput($eventId);
    }


    private function validateInput($input) {
        
        $input = trim($input);
        
        
        $input = strip_tags($input);
        
        
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        
        
        
        return $input;
    }
    
}

