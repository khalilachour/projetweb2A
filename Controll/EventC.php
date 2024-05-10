<?php
require_once 'Model/Event.php';

class EventC {
    private $eventModel;

    public function __construct(PDO $pdo) {
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
}
