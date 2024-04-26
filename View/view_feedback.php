<?php foreach ($feedbacks as $feedback): ?>
    <div class="feedback">
        <p class="candidate-name"><strong>Candidate Name:</strong> <?php echo $feedback['candidate_name']; ?></p>
        <p class="feedback-text"><strong>Feedback Text:</strong> <?php echo $feedback['feedback_text']; ?></p>
        <p class="satisfaction-rating"><strong>Satisfaction Rating:</strong> <?php echo $feedback['satisfaction_rating']; ?></p>
        <!-- Other feedback details -->
    </div>
<?php endforeach; ?>
