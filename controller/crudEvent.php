<?php
class CrudEvent {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createRecruitmentEvent($candidateName, $description, $date, $place, $eventName, $eventType) {
        $sql = "INSERT INTO recruitment_events (candidate_name, description, date, place, event_name, event_type) VALUES ('$candidateName', '$description', '$date', '$place', '$eventName', '$eventType')";
        if ($this->conn->query($sql) === TRUE) {
            return "New event created successfully";
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

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

    public function updateRecruitmentEvent($eventID, $candidateName, $description, $date, $place, $eventName, $eventType) {
        $sql = "UPDATE recruitment_events SET candidate_name='$candidateName', description='$description', date='$date', place='$place', event_name='$eventName', event_type='$eventType' WHERE id=$eventID";
        if ($this->conn->query($sql) === TRUE) {
            return "Event updated successfully";
        } else {
            return "Error updating record: " . $this->conn->error;
        }
    }

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
