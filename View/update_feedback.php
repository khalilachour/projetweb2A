<form action="update_feedback.php" method="post" class="feedback-form">
    <!-- Hidden field to store the feedback ID -->
    <input type="hidden" name="feedback_id" value="<?php echo $feedback['feedback_id']; ?>">

    <!-- Form fields for feedback details -->
    <input type="text" name="candidate_name" value="<?php echo $feedback['candidate_name']; ?>" placeholder="Your Name" class="candidate-name"> <!-- Optional field for candidate's name -->
    <textarea name="feedback_text" placeholder="Feedback" required class="feedback-text"><?php echo $feedback['feedback_text']; ?></textarea> <!-- Textarea for feedback text -->
    <label for="satisfaction_rating" class="satisfaction-rating-label">Satisfaction Rating:</label> <!-- Label for rating input -->
    <input type="number" name="satisfaction_rating" id="satisfaction_rating" min="1" max="5" value="<?php echo $feedback['satisfaction_rating']; ?>" required class="satisfaction-rating"> <!-- Rating input -->
    <!-- Other feedback details -->

    <button type="submit" class="submit-button">Update Feedback</button>
</form>
