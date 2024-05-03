<?php
require_once 'Model/Feedback.php';

// FeedbackC class
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
                // Other feedback details...
            ];

            // Call the model method to create the feedback
            $this->feedbackModel->createFeedback($feedbackData);

            // Redirect to a success page or display a success message
            header('Location: index.php?action=viewFeedback&eventId=' . $_POST['event_id']);
            exit();
        }

        // If not a POST request, include the view file
        include('View/create_feedback.php');
    }

    public function viewFeedback($eventId) {
        // Retrieve feedback for the specified event from the database
        $feedback = $this->feedbackModel->getFeedback($eventId);

        // Include the view file and pass feedback data to it
        include('View/view_feedback.php');
    }

    public function updateFeedback($feedbackId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $feedbackData = [
                'feedback_text' => $_POST['feedback_text'],
                'satisfaction_rating' => $_POST['satisfaction_rating'],
                // Other feedback details...
            ];

            // Call the model method to update the feedback
            $this->feedbackModel->updateFeedback($feedbackId, $feedbackData);

            // Redirect to a success page or display a success message
            header('Location: index.php?action=viewFeedback&eventId=' . $_POST['event_id']);
            exit();
        }

        // Retrieve current feedback details from the database
        $feedback = $this->feedbackModel->getFeedbackById($feedbackId);

        // Include the view file and pass feedback data to it
        include('View/update_feedback.php');
    }

    public function deleteFeedback($feedbackId) {
        // Handle deletion of feedback
        $this->feedbackModel->deleteFeedback($feedbackId);

        // Redirect to a success page or display a success message
        header('Location: index.php');
        exit();
    }

    public function readAllFeedback() {
        // Call the model method to retrieve all feedback entries
        $feedbackEntries = $this->feedbackModel->readAllFeedback();

        // Return the retrieved feedback entries
        return $feedbackEntries;
    }

    public function searchFeedbackByName($candidateName) {
        // Call the model method to search for feedback entries by candidate name
        $feedbackEntries = $this->feedbackModel->searchFeedbackByName($candidateName);

        // Return the retrieved feedback entries
        return $feedbackEntries;
    }
}

