<?php
require_once 'Model/Feedback.php';

class FeedbackC {
    private $feedbackModel;
    private $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->feedbackModel = new Feedback($pdo);
    }

    public function createFeedback() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $feedbackData = [
                'event_id' => $_POST['event_id'],
                'candidate_name' => $_POST['candidate_name'], // Optional, remove if not used
                'feedback_text' => $_POST['feedback_text'],
                'satisfaction_rating' => $_POST['satisfaction_rating'],
            ];

            // Create feedback
            $this->feedbackModel->createFeedback($feedbackData);

            // Redirect to view feedback page
            header('Location: index2.php?eventId=' . $_POST['event_id']);

            exit();
        }

        // Include create feedback view
        include('View/create_feedback.php');
    }

    public function viewFeedback($eventId) {
        // Retrieve feedback for the specified event from the database
        $feedback = $this->feedbackModel->getFeedback($eventId);

        include('View/view_feedback.php');
    }

    public function updateFeedback($feedbackId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $feedbackData = [
                'feedback_text' => $_POST['feedback_text'],
                'satisfaction_rating' => $_POST['satisfaction_rating'],
            ];

            
            $this->feedbackModel->updateFeedback($feedbackId, $feedbackData);

            
            header('Location: index2.php?eventId=' . $_POST['event_id']);

            exit();
        }

        
        $feedback = $this->feedbackModel->getFeedbackById($feedbackId);

        include('View/update_feedback.php');
    }

    public function deleteFeedback($feedbackId) {
       
        $this->feedbackModel->deleteFeedback($feedbackId);

       
        header('Location: index2.php');
        exit();
    }

    public function readAllFeedback() {
        
        $feedbackEntries = $this->feedbackModel->readAllFeedback();
        return $feedbackEntries;
    }

    public function searchFeedbackByName($candidateName) {
        
        $feedbackEntries = $this->feedbackModel->searchFeedback($candidateName);
        return $feedbackEntries;
    }
    

    public function reportFeedback($feedbackId) {
        try {
            // Retrieve the feedback text from the database
            $stmt = $this->pdo->prepare("SELECT feedback_text FROM feedback WHERE feedback_id = ?");
            $stmt->execute([$feedbackId]);
            $feedbackText = $stmt->fetchColumn();
    
            // Censor foul words in the feedback text
            $censoredText = $this->censorFoulWords($feedbackText);
    
            // Update the feedback entry with the censored text and set reported flag to 1
            $stmt = $this->pdo->prepare("UPDATE feedback SET feedback_text = REPLACE(feedback_text, ?, '****'), reported = 1 WHERE feedback_id = ?");
            $stmt->execute([$feedbackText, $feedbackId]);
    
            // Return true to indicate successful reporting
            return true;
        } catch (PDOException $e) {
            // Log or handle the error appropriately
            error_log("Error reporting feedback: " . $e->getMessage());
            // Return false to indicate failure in case of any errors
            return false;
        }
    }
    

    // Function to censor foul words in the feedback text
    private function censorFoulWords($text) {
        // Define an array of foul words to censor
        $foulWords = ['bastard', 'jackass', 'idiot'];

        // Loop through each foul word and replace it with asterisks
        foreach ($foulWords as $word) {
            // Create a regular expression with word boundaries (\b) to match whole words only
            $regex = '/\b' . preg_quote($word, '/') . '\b/i';
            $text = preg_replace($regex, str_repeat('*', strlen($word)), $text);
        }

        return $text;
    }
    
}

