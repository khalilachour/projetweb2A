<?php
class Event {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
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

    public function createEvent($eventData) {
        // Validate event data
        $eventData = array_map(array($this, 'validateInput'), $eventData);

        // Insert new event into the database
        $sql = "INSERT INTO events (event_name, event_type, event_date, event_place, event_description, ticket_price, ticket_number) VALUES (:event_name, :event_type, :event_date, :event_place, :event_description, :ticket_price, :ticket_number)";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':event_name' => $eventData['event_name'],
                ':event_type' => $eventData['event_type'],
                ':event_date' => $eventData['event_date'],
                ':event_place' => $eventData['event_place'],
                ':event_description' => $eventData['event_description'],
                ':ticket_price' => $eventData['ticket_price'],
                ':ticket_number' => $eventData['ticket_number']
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getEvent($eventId) {
        // Fetch event data from the database
        $sql = "SELECT * FROM events WHERE event_id = :event_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':event_id' => $eventId]);
        $event = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Check if event exists
        if ($event) {
            return $event; // Return event data if found
        } else {
            return false; // Return false if event not found
        }
    }
    
    public function updateEvent($eventId, $eventData) {
        // Validate event data
        $eventData = array_map(array($this, 'validateInput'), $eventData);
        // Validate event ID
        $eventId = $this->validateInput($eventId);

        // Update event in the database
        $sql = "UPDATE events SET event_name = :event_name, event_type = :event_type, event_date = :event_date, event_place = :event_place, event_description = :event_description, ticket_price = :ticket_price, ticket_number = :ticket_number WHERE event_id = :event_id";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':event_id' => $eventId,
                ':event_name' => $eventData['event_name'],
                ':event_type' => $eventData['event_type'],
                ':event_date' => $eventData['event_date'],
                ':event_place' => $eventData['event_place'],
                ':event_description' => $eventData['event_description'],
                ':ticket_price' => $eventData['ticket_price'],
                ':ticket_number' => $eventData['ticket_number']
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteEvent($eventId) {
        // Validate event ID
        $eventId = $this->validateInput($eventId);

        // Delete event from the database
        $sql = "DELETE FROM events WHERE event_id = :event_id";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':event_id' => $eventId]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function searchEventByName($eventName) {
        // Validate event name for search
        $eventName = $this->validateInput($eventName);

        // Search events by name in the database
        $sql = "SELECT * FROM events WHERE event_name LIKE :event_name";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':event_name' => '%' . $eventName . '%']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function getAllEvents() {
        // Retrieve all events from the database
        $sql = "SELECT * FROM events";
        
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function isEventNameUnique($eventName) {
        // Check if event name is unique in the database
        $sql = "SELECT COUNT(*) FROM events WHERE event_name = :event_name";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':event_name' => $eventName]);
            $count = $stmt->fetchColumn();
            
            // If count is 0, event name is unique
            return $count === 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function isEventNameUniqueExcept($eventName, $eventId) {
        // Check if event name is unique excluding the current event being updated
        $sql = "SELECT COUNT(*) FROM events WHERE event_name = :event_name AND event_id != :event_id";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':event_name' => $eventName, ':event_id' => $eventId]);
            $count = $stmt->fetchColumn();
            
            // If count is 0, event name is unique
            return $count === 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function isValidEventType($eventType) {
        // Check if event type is valid
        $validTypes = ['training', 'entertainment', 'commercial'];
        return in_array($eventType, $validTypes);
    }

    public function updateTicketAvailability($eventId, $quantity) {
        // Update number of available tickets for the event
        $sql = "UPDATE events SET ticket_number = :ticket_number WHERE event_id = :event_id";
    
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':ticket_number' => $quantity, ':event_id' => $eventId]);
            echo "Ticket availability updated successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    
    public function createTicketPurchase($eventId, $candidateName) {
        // Fetch event information from the database
        $event = $this->eventModel->getEvent($eventId);
    
        // Check if the event exists
        if (!$event) {
            echo "Error: Event not found";
            return;
        }
    
        // Extract event details
        $eventName = $event['event_name'];
        $eventPlace = $event['event_place'];
        $eventDate = $event['event_date'];
        $eventDescription = $event['event_description'];
    
        // Construct receipt
        $receipt = "Candidate Name: $candidateName\n";
        $receipt .= "Event Name: $eventName\n";
        $receipt .= "Event Place: $eventPlace\n";
        $receipt .= "Event Date: $eventDate\n";
        $receipt .= "Event Description: $eventDescription";
    
        // Insert new ticket purchase record into ticket_purchases table
        $sql = "INSERT INTO ticket_purchases (candidate_name, event_id, receipt) VALUES (:candidate_name, :event_id, :receipt)";
    
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':event_id' => $eventId, ':candidate_name' => $candidateName, ':receipt' => $receipt]);
            echo "Ticket purchased successfully!\n";
            echo "Receipt:\n";
            echo $receipt; // Output the receipt
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    


}
