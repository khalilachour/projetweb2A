<?php
class CrudFeedback {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Function to create a new recruitment feedback
    public function createRecruitmentFeedback($candidateID, $feedbackText) {
        $status = 'Pending';
        $sql = "INSERT INTO recruitment_feedback (candidate_id, feedback_text, status) VALUES ('$candidateID', '$feedbackText', '$status')";
        if ($this->conn->query($sql) === TRUE) {
            return "New feedback created successfully";
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    // Function to read recruitment feedback
    public function readRecruitmentFeedback($filter = '') {
        $sql = "SELECT * FROM recruitment_feedback";
        if (!empty($filter)) {
            $sql .= " WHERE $filter";
        }
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return "No feedback found";
        }
    }

    // Function to update a recruitment feedback
    public function updateRecruitmentFeedback($feedbackID, $feedbackText, $status) {
        $sql = "UPDATE recruitment_feedback SET feedback_text='$feedbackText', status='$status' WHERE id=$feedbackID";
        if ($this->conn->query($sql) === TRUE) {
            return "Feedback updated successfully";
        } else {
            return "Error updating record: " . $this->conn->error;
        }
    }

    // Function to delete a recruitment feedback
    public function deleteRecruitmentFeedback($feedbackID) {
        $sql = "DELETE FROM recruitment_feedback WHERE id=$feedbackID";
        if ($this->conn->query($sql) === TRUE) {
            return "Feedback deleted successfully";
        } else {
            return "Error deleting record: " . $this->conn->error;
        }
    }
}
?>
