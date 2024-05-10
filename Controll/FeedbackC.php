<?php
require_once 'Model/Feedback.php';

class FeedbackC {
    private $feedbackModel;

    public function __construct(PDO $pdo) {
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
            header('Location: index.php?action=viewFeedback&eventId=' . $_POST['event_id']);
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

            // Update feedback
            $this->feedbackModel->updateFeedback($feedbackId, $feedbackData);

            // Redirect to view feedback page
            header('Location: index.php?action=viewFeedback&eventId=' . $_POST['event_id']);
            exit();
        }

        // Retrieve feedback by ID for updating
        $feedback = $this->feedbackModel->getFeedbackById($feedbackId);

        include('View/update_feedback.php');
    }

    public function deleteFeedback($feedbackId) {
        // Delete feedback
        $this->feedbackModel->deleteFeedback($feedbackId);

        // Redirect to index
        header('Location: index.php');
        exit();
    }

    public function readAllFeedback() {
        // Read all feedback entries
        $feedbackEntries = $this->feedbackModel->readAllFeedback();
        return $feedbackEntries;
    }

    public function searchFeedbackByName($candidateName) {
        // Search feedback by candidate name
        $feedbackEntries = $this->feedbackModel->searchFeedback($candidateName);
        return $feedbackEntries;
    }
}
