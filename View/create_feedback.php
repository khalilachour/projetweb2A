<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form action="create_feedback.php" method="post">
    <!-- Form fields for feedback details -->
    <input type="hidden" name="event_id" value="<?php echo $eventId; ?>"> <!-- Hidden field to store event ID -->
    <input type="text" name="candidate_name" placeholder="Your Name"> <!-- Optional field for candidate's name -->
    <textarea name="feedback_text" placeholder="Feedback" required></textarea> <!-- Textarea for feedback text -->
    <label for="satisfaction_rating">Satisfaction Rating:</label> <!-- Label for rating input -->
    <input type="number" name="satisfaction_rating" id="satisfaction_rating" min="1" max="5" required> <!-- Rating input -->
    <!-- Other feedback details -->

    <button type="submit">Submit Feedback</button>
</form>

</body>
</html>
