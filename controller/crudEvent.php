class CrudEvent {
    private $conn;

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to create a new event
    public function createEvent($eventName, $eventType, $date, $location, $description) {
        // Validate input
        $this->validateInput($eventName, $eventType, $date, $location, $description);

        // Sanitize input
        $eventName = mysqli_real_escape_string($this->conn, $eventName);
        $eventType = mysqli_real_escape_string($this->conn, $eventType);
        $date = mysqli_real_escape_string($this->conn, $date);
        $location = mysqli_real_escape_string($this->conn, $location);
        $description = mysqli_real_escape_string($this->conn, $description);

        // Insert event into database
        $sql = "INSERT INTO events (event_name, event_type, date, location, description) VALUES ('$eventName', '$eventType', '$date', '$location', '$description')";
        if ($this->conn->query($sql)) {
            return "Event created successfully";
        } else {
            throw new Exception("Error creating event: " . $this->conn->error);
        }
    }

    // Method to read events
    public function readEvents($filter = '') {
        // Sanitize filter input
        $filter = mysqli_real_escape_string($this->conn, $filter);

        // Construct SQL query
        $sql = "SELECT * FROM events";
        if (!empty($filter)) {
            $sql .= " WHERE $filter";
        }

        // Execute query
        $result = $this->conn->query($sql);
        if ($result) {
            // Fetch data
            $eventsData = [];
            while ($row = $result->fetch_assoc()) {
                $eventsData[] = $row;
            }
            return $eventsData;
        } else {
            throw new Exception("Error reading events: " . $this->conn->error);
        }
    }

    // Method to update an existing event
    public function updateEvent($eventId, $eventName, $eventType, $date, $location, $description) {
        // Validate input
        $this->validateInput(null, $eventName, $eventType, $date, $location, $description);

        // Sanitize input
        $eventId = mysqli_real_escape_string($this->conn, $eventId);
        $eventName = mysqli_real_escape_string($this->conn, $eventName);
        $eventType = mysqli_real_escape_string($this->conn, $eventType);
        $date = mysqli_real_escape_string($this->conn, $date);
        $location = mysqli_real_escape_string($this->conn, $location);
        $description = mysqli_real_escape_string($this->conn, $description);

        // Update event in database
        $sql = "UPDATE events SET event_name='$eventName', event_type='$eventType', date='$date', location='$location', description='$description' WHERE id='$eventId'";
        if ($this->conn->query($sql)) {
            return "Event updated successfully";
        } else {
            throw new Exception("Error updating event: " . $this->conn->error);
        }
    }

    // Method to delete an event
    public function deleteEvent($eventId) {
        // Validate event ID
        if (!is_numeric($eventId) || $eventId <= 0) {
            throw new InvalidArgumentException("Event ID must be a positive integer.");
        }

        // Sanitize input
        $eventId = mysqli_real_escape_string($this->conn, $eventId);

        // Delete event from database
        $sql = "DELETE FROM events WHERE id='$eventId'";
        if ($this->conn->query($sql)) {
            return "Event deleted successfully";
        } else {
            throw new Exception("Error deleting event: " . $this->conn->error);
        }
    }

    // Method to validate input
    private function validateInput($eventName, $eventType, $date, $location, $description) {
        // Validate event name
        if (empty($eventName) || strlen($eventName) > 255) {
            throw new InvalidArgumentException("Event name must be between 1 and 255 characters long.");
        }

        // Validate event type
        if (empty($eventType) || strlen($eventType) > 50) {
            throw new InvalidArgumentException("Event type must be between 1 and 50 characters long.");
        }

        // Validate date
        $dateObj = DateTime::createFromFormat('Y-m-d', $date);
        if (!$dateObj) {
            throw new InvalidArgumentException("Invalid date format. Date should be in YYYY-MM-DD format.");
        }

        // Validate location
        if (empty($location) || strlen($location) > 255) {
            throw new InvalidArgumentException("Location must be between 1 and 255 characters long.");
        }

        // Validate description
        if (empty($description)) {
            throw new InvalidArgumentException("Description must not be empty.");
        }
    }
}
