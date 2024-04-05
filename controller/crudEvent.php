<?php
class CrudEvent {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Function to create a new recruitment event
    public function createRecruitmentEvent($eventName, $eventType, $date, $location, $description) {
        $sql = "INSERT INTO recruitment_events (event_name, event_type, date, location, description) VALUES ('$eventName', '$eventType', '$date', '$location', '$description')";
        if ($this->conn->query($sql) === TRUE) {
            return "New event created successfully";
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    // Function to read recruitment events
    public function readRecruitmentEvents($filter = '') {
        $sql = "SELECT * FROM recruitment_events";
        if (!empty($filter)) {
            $sql .= " WHERE $filter";
        }
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return "No events found";
        }
    }

    // Function to update a recruitment event
    public function updateRecruitmentEvent($eventID, $eventName, $eventType, $date, $location, $description) {
        $sql = "UPDATE recruitment_events SET event_name='$eventName', event_type='$eventType', date='$date', location='$location', description='$description' WHERE id=$eventID";
        if ($this->conn->query($sql) === TRUE) {
            return "Event updated successfully";
        } else {
            return "Error updating record: " . $this->conn->error;
        }
    }

    // Function to delete a recruitment event
    public function deleteRecruitmentEvent($eventID) {
        $sql = "DELETE FROM recruitment_events WHERE id=$eventID";
        if ($this->conn->query($sql) === TRUE) {
            return "Event deleted successfully";
        } else {
            return "Error deleting record: " . $this->conn->error;
        }
    }
}
?>
