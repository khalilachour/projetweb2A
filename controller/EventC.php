<?php
require_once 'Model/Event.php';

class EventC {
    private $pdo;
    private $eventModel;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->eventModel = new Event($pdo);
    }
    public function getEvent($eventId) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM events WHERE event_id = :event_id");
            $stmt->bindParam(':event_id', $eventId);
            $stmt->execute();
            $eventDetails = $stmt->fetch(PDO::FETCH_ASSOC);
            return $eventDetails;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function createEvent() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate event data
            $eventData = $this->validateEventData($_POST);

            // Additional validation for event name uniqueness
            if ($this->eventModel->isEventNameUnique($eventData['event_name'])) {
                // Check if event time is not in the past
                if (strtotime($eventData['event_date']) > time()) {
                    // Check if event type is valid
                    if (in_array($eventData['event_type'], ['training', 'entertainment', 'commercial'])) {
                        // Create event
                        $this->eventModel->createEvent($eventData);
                        header('Location: index.php?action=viewEvent');
                        exit();
                    } else {
                        echo "Invalid event type. Allowed types are: training, entertainment, commercial.";
                    }
                } else {
                    echo "Event time cannot be in the past.";
                }
            } else {
                echo "Event name already exists. Please choose a different name.";
            }
        }

        include('View/create_event.php');
    }

    public function viewEvent($eventId) {
        // Fetch event data for viewing
        $event = $this->eventModel->getEvent($eventId);

        include('View/view_event.php');
    }

    public function updateEvent($eventId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate event data
            $eventData = $this->validateEventData($_POST);

            // Additional validation for event name uniqueness
            if ($this->eventModel->isEventNameUniqueExcept($eventData['event_name'], $eventId)) {
                // Check if event time is not in the past
                if (strtotime($eventData['event_date']) > time()) {
                    // Check if event type is valid
                    if ($this->eventModel->isValidEventType($eventData['event_type'])) {
                        // Update event
                        $this->eventModel->updateEvent($eventId, $eventData);
                        header('Location: index.php?action=viewEvent&eventId=' . $eventId);
                        exit();
                    } else {
                        echo "Invalid event type. Allowed types are: training, entertainment, commercial.";
                    }
                } else {
                    echo "Event time cannot be in the past.";
                }
            } else {
                echo "Event name already exists. Please choose a different name.";
            }
        }

        // Fetch event data for updating
        $event = $this->eventModel->getEvent($eventId);

        include('View/update_event.php');
    }

    public function deleteEvent($eventId) {
        // Validate event ID
        $eventId = $this->validateEventId($eventId);

        // Delete event
        $this->eventModel->deleteEvent($eventId);

        header('Location: index.php');
        exit();
    }

    public function searchEvent($eventName) {
        // Validate search input
        $eventName = $this->validateInput($eventName);

        // Search events by name
        $events = $this->eventModel->searchEventByName($eventName);

        include('View/search_event.php');

        return $events;
    }

    public function readAll() {
        // Fetch all events
        $events = $this->eventModel->getAllEvents();

        return $events;
    }

    private function validateEventData($data) {
        $validatedData = [];
        foreach ($data as $key => $value) {
            $validatedData[$key] = $this->validateInput($value);
        }
        // Additional validation for new fields
        $validatedData['ticket_price'] = isset($validatedData['ticket_price']) ? $validatedData['ticket_price'] : null;
        $validatedData['ticket_number'] = isset($validatedData['ticket_number']) ? $validatedData['ticket_number'] : null;
        return $validatedData;
    }

    private function validateEventId($eventId) {
        // Validate event ID
        return $this->validateInput($eventId);
    }

    private function validateInput($input) {
        // Trim the input to remove leading and trailing spaces
        $input = trim($input);
        // Remove any HTML tags to prevent XSS attacks
        $input = strip_tags($input);
        // Convert special characters to HTML entities to prevent injection attacks
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

        return $input;
    }


    public function getAllEventsSortedByName() {
        $sql = "SELECT * FROM events ORDER BY event_name";
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function buyTicket($eventId, $candidateName) {
        try {
            // Get event details
            $eventDetails = $this->getEvent($eventId);
            
            // Check if event details were retrieved successfully
            if ($eventDetails !== false) {
                // Update ticket count
                $stmt = $this->pdo->prepare("UPDATE events SET ticket_number = ticket_number - 1 WHERE event_id = :event_id");
                $stmt->bindParam(':event_id', $eventId);
                $stmt->execute();
    
                // Generate receipt
                $receipt = $candidateName . '/event name: ' . $eventDetails['event_name'] . '/even place: ' . $eventDetails['event_place'] . '/event date: ' . $eventDetails['event_date'] . '/event description: ' . $eventDetails['event_description'] . '/ticket price: ' . $eventDetails['ticket_price'];
    
                // Insert into ticket_purchases table
                $stmt = $this->pdo->prepare("INSERT INTO ticket_purchases (candidate_name, event_id, receipt) VALUES (:candidate_name, :event_id, :receipt)");
                $stmt->bindParam(':candidate_name', $candidateName);
                $stmt->bindParam(':event_id', $eventId);
                $stmt->bindParam(':receipt', $receipt);
                $stmt->execute();
                
                return true;
            } else {
                // Event details not found
                return false;
            }
        } catch (PDOException $e) {
            // Handle any PDO exceptions
            return false;
        }
    }
    public function readAllTicketPurchases()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM ticket_purchases");
            $stmt->execute();
            $ticketPurchases = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $ticketPurchases;
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array in case of error
        }
    }
   
    
    

}
