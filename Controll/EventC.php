<?php
require_once 'Model/Event.php';

class EventC {
    private $eventModel;

    public function __construct(PDO $pdo) {
        $this->eventModel = new Event($pdo);
    }

    public function createEvent() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $eventData = [
                'event_name' => $_POST['event_name'],
                'event_type' => $_POST['event_type'],
                'event_date' => $_POST['event_date'],
                'event_place' => $_POST['event_place'],
                'event_description' => $_POST['event_description'],
                // Other event details...
            ];

            // Call the model method to create the event
            $this->eventModel->createEvent($eventData);

            // Redirect to a success page or display a success message
            header('Location: index.php?action=viewEvent');
            exit();
        }

        // If not a POST request, include the view file
        include('View/create_event.php');
    }

    public function viewEvent($eventId) {
        // Retrieve event details from the database
        $event = $this->eventModel->getEvent($eventId);

        // Include the view file and pass event data to it
        include('View/view_event.php');
    }

    public function updateEvent($eventId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $eventData = [
                'event_name' => $_POST['event_name'],
                'event_type' => $_POST['event_type'],
                'event_date' => $_POST['event_date'],
                'event_place' => $_POST['event_place'],
                'event_description' => $_POST['event_description'],
                // Other event details...
            ];

            // Call the model method to update the event
            $this->eventModel->updateEvent($eventId, $eventData); // Pass both event ID and event data

            // Redirect to a success page or display a success message
            header('Location: index.php?action=viewEvent&eventId=' . $eventId);
            exit();
        }

        // Retrieve current event details from the database
        $event = $this->eventModel->getEvent($eventId);

        // Include the view file and pass event data to it
        include('View/update_event.php');
    }

    public function deleteEvent($eventId) {
        // Handle deletion of the event
        $this->eventModel->deleteEvent($eventId);

        // Redirect to a success page or display a success message
        header('Location: index.php');
        exit();
    }

    public function readAll() {
        // Retrieve all events from the database
        $events = $this->eventModel->getAllEvents();

        // Include the view file and pass event data to it
        include('View/all_events.php');
    }
}

