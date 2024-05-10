<?php

class Feedback {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Sanitize feedback text
    private function sanitizeFeedbackText($feedbackText) {
        return substr(trim($feedbackText), 0, 50);
    }

    // Validate satisfaction rating
    private function validateSatisfactionRating($satisfactionRating) {
        return ($satisfactionRating >= 1 && $satisfactionRating <= 5);
    }
     
    public function createFeedback($feedbackData) {
        // Sanitize and validate feedback text
        $feedbackText = $this->sanitizeFeedbackText($feedbackData['feedback_text']);

        // Validate satisfaction rating
        $satisfactionRating = $feedbackData['satisfaction_rating'];
        if (!$this->validateSatisfactionRating($satisfactionRating)) {
            echo "Error: Satisfaction rating must be between 1 and 5.";
            return;
        }

        // Get current date and time
        $currentDate = date('Y-m-d');

        $sql = "INSERT INTO feedback (event_id, candidate_name, feedback_text, satisfaction_rating, date_feedback) VALUES (:event_id, :candidate_name, :feedback_text, :satisfaction_rating, :date_feedback)";
        
        try {
            // Prepare and execute SQL statement
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':event_id' => $feedbackData['event_id'],
                ':candidate_name' => $feedbackData['candidate_name'], 
                ':feedback_text' => $feedbackText,
                ':satisfaction_rating' => $satisfactionRating,
                ':date_feedback' => $currentDate
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateFeedback($feedbackId, $feedbackData) {
        // Sanitize and validate feedback text
        $feedbackText = $this->sanitizeFeedbackText($feedbackData['feedback_text']);

        // Validate satisfaction rating
        $satisfactionRating = $feedbackData['satisfaction_rating'];
        if (!$this->validateSatisfactionRating($satisfactionRating)) {
            echo "Error: Satisfaction rating must be between 1 and 5.";
            return;
        }

        // Get current date
        $currentDate = date('Y-m-d');

        $sql = "UPDATE feedback SET feedback_text = :feedback_text, satisfaction_rating = :satisfaction_rating, date_feedback = :date_feedback WHERE feedback_id = :feedback_id";
        
        try {
            // Prepare and execute SQL statement
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':feedback_id' => $feedbackId,
                ':feedback_text' => $feedbackText,
                ':satisfaction_rating' => $satisfactionRating,
                ':date_feedback' => $currentDate // Update with current date
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteFeedback($feedbackId) {
        $sql = "DELETE FROM feedback WHERE feedback_id = :feedback_id";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':feedback_id' => $feedbackId]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    
    public function readAllFeedback() {
        $sql = "SELECT * FROM feedback";

        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function searchFeedback($candidateName) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM feedback WHERE candidate_name LIKE ?");
            $stmt->execute(["%$candidateName%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error: Could not search feedback by name. " . $e->getMessage());
        }
    }
    
}
