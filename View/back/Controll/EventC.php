<?php
require_once 'Model/Event.php';

class EventC {
    private $pdo;
    private $eventModel;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->eventModel = new Event($pdo);
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
                        header('Location: index1.php?action=viewEvent');
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
                        header('Location: index1.php?action=viewEvent&eventId=' . $eventId);
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

        header('Location: index1.php');
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
        // Fetch event information from the database
        $event = $this->eventModel->getEvent($eventId);

    // Check if the event exists
    if ($event === false) {
        echo "Error: Event not found";
        return;
    }
    
        // Extract available tickets count
        $availableTickets = $event['ticket_number'];
    
        if ($availableTickets > 0) {
            try {
                // Decrease the available tickets count
                $this->eventModel->updateTicketAvailability($eventId, $availableTickets - 1);
    
                // Construct receipt
                $receipt = "Ticket purchased for event: " . $event['event_name'] . "\n";
                $receipt .= "Candidate Name: $candidateName\n";
    
                // Insert ticket purchase record
                $this->eventModel->createTicketPurchase($eventId, $candidateName, $receipt);
    
                echo "Ticket purchased successfully!\n";
                echo "Receipt:\n";
                echo $receipt; // Output the receipt
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "No available tickets for this event.";
        }
    }
    
    

}
