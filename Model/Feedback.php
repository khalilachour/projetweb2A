<?php
// Feedback class
class Feedback {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createFeedback($feedbackData) {
        $sql = "INSERT INTO feedback (event_id, candidate_name, feedback_text, satisfaction_rating) VALUES (:event_id, :candidate_name, :feedback_text, :satisfaction_rating)";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':event_id' => $feedbackData['event_id'],
                ':candidate_name' => $feedbackData['candidate_name'], // Optional, remove if not used
                ':feedback_text' => $feedbackData['feedback_text'],
                ':satisfaction_rating' => $feedbackData['satisfaction_rating']
            ]);
        } catch (PDOException $e) {
            // Handle the exception
            echo "Error: " . $e->getMessage();
        }
    }

    public function getFeedback($eventId) {
        $sql = "SELECT * FROM feedback WHERE event_id = :event_id";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':event_id' => $eventId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the exception
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateFeedback($feedbackId, $feedbackData) {
        $sql = "UPDATE feedback SET feedback_text = :feedback_text, satisfaction_rating = :satisfaction_rating WHERE feedback_id = :feedback_id";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':feedback_id' => $feedbackId,
                ':feedback_text' => $feedbackData['feedback_text'],
                ':satisfaction_rating' => $feedbackData['satisfaction_rating']
            ]);
        } catch (PDOException $e) {
            // Handle the exception
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteFeedback($feedbackId) {
        $sql = "DELETE FROM feedback WHERE feedback_id = :feedback_id";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':feedback_id' => $feedbackId]);
        } catch (PDOException $e) {
            // Handle the exception
            echo "Error: " . $e->getMessage();
        }
    }

    
    public function readAllFeedback() {
        $sql = "SELECT * FROM feedback";

        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the exception
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function searchFeedbackByName($candidateName) {
        $sql = "SELECT * FROM feedback WHERE candidate_name LIKE :candidate_name";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':candidate_name' => '%' . $candidateName . '%']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the exception
            echo "Error: " . $e->getMessage();
        }
    }
}

