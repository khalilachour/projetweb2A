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
        // Validate event ID
        $eventId = $this->validateInput($eventId);

        // Retrieve event from the database
        $sql = "SELECT * FROM events WHERE event_id = :event_id";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':event_id' => $eventId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
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
}
