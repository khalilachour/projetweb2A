<?php
class Feedback {
    private $candidateID;
    private $candidateName;
    private $feedbackText;
    private $satisfactionRating;

    public function __construct($candidateID, $candidateName, $feedbackText, $satisfactionRating) {
        $this->candidateID = $candidateID;
        $this->candidateName = $candidateName;
        $this->feedbackText = $feedbackText;
        $this->satisfactionRating = $satisfactionRating;
    }

    public function provideFeedback($conn) {
        $sql = "INSERT INTO recruitment_feedback (candidate_id, candidate_name, feedback, satisfaction_rating) VALUES ('$this->candidateID', '$this->candidateName', '$this->feedbackText', '$this->satisfactionRating')";
        if ($conn->query($sql) === TRUE) {
            return "Feedback provided successfully";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
