<?php
class CrudFeedback {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createRecruitmentFeedback($candidateID, $candidateName, $feedbackText, $satisfactionRating) {
        $sql = "INSERT INTO recruitment_feedback (candidate_id, candidate_name, feedback, satisfaction_rating) VALUES ('$candidateID', '$candidateName', '$feedbackText', '$satisfactionRating')";
        if ($this->conn->query($sql) === TRUE) {
            return "New feedback created successfully";
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

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

    public function updateRecruitmentFeedback($feedbackID, $feedbackText, $satisfactionRating) {
        $sql = "UPDATE recruitment_feedback SET feedback='$feedbackText', satisfaction_rating='$satisfactionRating' WHERE id=$feedbackID";
        if ($this->conn->query($sql) === TRUE) {
            return "Feedback updated successfully";
        } else {
            return "Error updating record: " . $this->conn->error;
        }
    }

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
