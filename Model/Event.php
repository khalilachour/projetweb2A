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
        
        $eventData = array_map(array($this, 'validateInput'), $eventData);

        $sql = "INSERT INTO events (event_name, event_type, event_date, event_place, event_description) VALUES (:event_name, :event_type, :event_date, :event_place, :event_description)";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':event_name' => $eventData['event_name'],
                ':event_type' => $eventData['event_type'],
                ':event_date' => $eventData['event_date'],
                ':event_place' => $eventData['event_place'],
                ':event_description' => $eventData['event_description']
            ]);
        } catch (PDOException $e) {
            
            echo "Error: " . $e->getMessage();
        }
    }

    public function getEvent($eventId) {
        
        $eventId = $this->validateInput($eventId);

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
        
        $eventData = array_map(array($this, 'validateInput'), $eventData);
        
        // Validate event ID
        $eventId = $this->validateInput($eventId);

        $sql = "UPDATE events SET event_name = :event_name, event_type = :event_type, event_date = :event_date, event_place = :event_place, event_description = :event_description WHERE event_id = :event_id";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':event_id' => $eventId,
                ':event_name' => $eventData['event_name'],
                ':event_type' => $eventData['event_type'],
                ':event_date' => $eventData['event_date'],
                ':event_place' => $eventData['event_place'],
                ':event_description' => $eventData['event_description']
            ]);
        } catch (PDOException $e) {
           
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteEvent($eventId) {
        
        $eventId = $this->validateInput($eventId);

        $sql = "DELETE FROM events WHERE event_id = :event_id";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':event_id' => $eventId]);
        } catch (PDOException $e) {
            
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function searchEventByName($eventName) {
        
        $eventName = $this->validateInput($eventName);

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
        $sql = "SELECT * FROM events";
        
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            
            echo "Error: " . $e->getMessage();
        }
    }
    
}

