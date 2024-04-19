class Feedback {
    private $feedbackId;
    private $candidateId;
    private $feedbackText;
    private $satisfactionRating;

    public function __construct($candidateId, $feedbackText, $satisfactionRating) {
        $this->setCandidateId($candidateId);
        $this->setFeedbackText($feedbackText);
        $this->setSatisfactionRating($satisfactionRating);
    }

    // Getters and Setters
    public function getFeedbackId() {
        return $this->feedbackId;
    }

    public function getCandidateId() {
        return $this->candidateId;
    }

    public function setCandidateId($candidateId) {
        // Validation logic for candidate ID can be added here
        $this->candidateId = $candidateId;
    }

    public function getFeedbackText() {
        return $this->feedbackText;
    }

    public function setFeedbackText($feedbackText) {
        // Validation logic for feedback text can be added here
        $this->feedbackText = $feedbackText;
    }

    public function getSatisfactionRating() {
        return $this->satisfactionRating;
    }

    public function setSatisfactionRating($satisfactionRating) {
        // Validation logic for satisfaction rating can be added here
        $this->satisfactionRating = $satisfactionRating;
    }
}
