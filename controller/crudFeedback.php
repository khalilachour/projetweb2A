class CrudFeedback {
    private $conn;

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to create feedback for an event
    public function createFeedback($eventId, $candidateId, $feedbackText, $satisfactionRating, $status) {
        // Validate input
        $this->validateInput($eventId, $candidateId, $feedbackText, $satisfactionRating, $status);

        // Sanitize input
        $eventId = mysqli_real_escape_string($this->conn, $eventId);
        $candidateId = mysqli_real_escape_string($this->conn, $candidateId);
        $feedbackText = mysqli_real_escape_string($this->conn, $feedbackText);
        $satisfactionRating = mysqli_real_escape_string($this->conn, $satisfactionRating);
        $status = mysqli_real_escape_string($this->conn, $status);

        // Insert feedback into database
        $sql = "INSERT INTO feedback (event_id, candidate_id, feedback_text, satisfaction_rating, status) VALUES ('$eventId', '$candidateId', '$feedbackText', '$satisfactionRating', '$status')";
        if ($this->conn->query($sql)) {
            return "Feedback created successfully";
        } else {
            throw new Exception("Error creating feedback: " . $this->conn->error);
        }
    }

    // Method to read feedback
    public function readFeedback($filter = '') {
        // Sanitize filter input
        $filter = mysqli_real_escape_string($this->conn, $filter);

        // Construct SQL query
        $sql = "SELECT * FROM feedback";
        if (!empty($filter)) {
            $sql .= " WHERE $filter";
        }

        // Execute query
        $result = $this->conn->query($sql);
        if ($result) {
            // Fetch data
            $feedbackData = [];
            while ($row = $result->fetch_assoc()) {
                $feedbackData[] = $row;
            }
            return $feedbackData;
        } else {
            throw new Exception("Error reading feedback: " . $this->conn->error);
        }
    }

    // Method to update feedback
    public function updateFeedback($feedbackId, $feedbackText, $satisfactionRating, $status) {
        // Validate input
        $this->validateInput(null, null, $feedbackText, $satisfactionRating, $status);

        // Sanitize input
        $feedbackId = mysqli_real_escape_string($this->conn, $feedbackId);
        $feedbackText = mysqli_real_escape_string($this->conn, $feedbackText);
        $satisfactionRating = mysqli_real_escape_string($this->conn, $satisfactionRating);
        $status = mysqli_real_escape_string($this->conn, $status);

        // Update feedback in database
        $sql = "UPDATE feedback SET feedback_text='$feedbackText', satisfaction_rating='$satisfactionRating', status='$status' WHERE id='$feedbackId'";
        if ($this->conn->query($sql)) {
            return "Feedback updated successfully";
        } else {
            throw new Exception("Error updating feedback: " . $this->conn->error);
        }
    }

    // Method to delete feedback
    public function deleteFeedback($feedbackId) {
        // Validate feedback ID
        if (!is_numeric($feedbackId) || $feedbackId <= 0) {
            throw new InvalidArgumentException("Feedback ID must be a positive integer.");
        }

        // Sanitize input
        $feedbackId = mysqli_real_escape_string($this->conn, $feedbackId);

        // Delete feedback from database
        $sql = "DELETE FROM feedback WHERE id='$feedbackId'";
        if ($this->conn->query($sql)) {
            return "Feedback deleted successfully";
        } else {
            throw new Exception("Error deleting feedback: " . $this->conn->error);
        }
    }

    // Method to validate input
    private function validateInput($eventId, $candidateId, $feedbackText, $satisfactionRating, $status) {
        // Validate event ID
        if (!is_numeric($eventId) || $eventId <= 0) {
            throw new InvalidArgumentException("Event ID must be a positive integer.");
        }

        // Validate candidate ID
        if (!is_numeric($candidateId) || $candidateId <= 0) {
            throw new InvalidArgumentException("Candidate ID must be a positive integer.");
        }

        // Validate feedback text
        if (empty($feedbackText)) {
            throw new InvalidArgumentException("Feedback text must not be empty.");
        }

        // Validate satisfaction rating
        if (!is_numeric($satisfactionRating) || $satisfactionRating < 1 || $satisfactionRating > 5) {
            throw new InvalidArgumentException("Satisfaction rating must be a number between 1 and 5.");
        }

        // Validate status
        if (!in_array($status, ['Pending', 'Reviewed'])) {
            throw new InvalidArgumentException("Invalid status. Status must be 'Pending' or 'Reviewed'.");
        }
    }
}
