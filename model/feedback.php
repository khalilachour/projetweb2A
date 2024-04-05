<?php
class Feedback {
    private $feedbackText;

    public function __construct($feedbackText) {
        $this->feedbackText = $feedbackText;
    }

    // Function to provide rating in feedback
    public function provideRating($feedbackID, $rating, $conn) {
        // Check if the rating provided is within the acceptable range (1 to 5)
        if ($rating < 1 || $rating > 5) {
            return "Error: Rating must be between 1 and 5.";
        }
        
        // Update the rating in the database
        $sql = "UPDATE recruitment_feedback SET rating=$rating WHERE id=$feedbackID";
        if ($conn->query($sql) === TRUE) {
            return "Rating provided successfully";
        } else {
            return "Error updating record: " . $conn->error;
        }
    }
}
?>
