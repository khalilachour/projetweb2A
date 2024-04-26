<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event and Feedback  Interface</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Event and Feedback  Interface</h1>

        <!-- Event CRUD Section -->
        <section>
            <h2>Event CRUD</h2>
            <!-- Create Event Form -->
            <h3>Create Event</h3>
            <form action="index.php?action=createEvent" method="post">
                <input type="text" name="event_name" placeholder="Event Name" required>
                <input type="text" name="event_type" placeholder="Event Type" required>
                <input type="date" name="event_date" required>
                <input type="text" name="event_place" placeholder="Event Place" required>
                <textarea name="event_description" placeholder="Event Description" required></textarea>
                <button type="submit">Create Event</button>
            </form>

            <!-- Update Event Form -->
            <h3>Update Event</h3>
            <form action="index.php?action=updateEvent" method="post">
                <input type="text" name="event_id" placeholder="Event ID to Update" required>
                <input type="text" name="event_name" placeholder="Event Name" required>
                <input type="text" name="event_type" placeholder="Event Type" required>
                <input type="date" name="event_date" required>
                <input type="text" name="event_place" placeholder="Event Place" required>
                <textarea name="event_description" placeholder="Event Description" required></textarea>
                <button type="submit">Update Event</button>
            </form>

            <!-- Delete Event Form -->
            <h3>Delete Event</h3>
            <form action="index.php?action=deleteEvent" method="post">
                <input type="text" name="event_id" placeholder="Event ID to Delete" required>
                <button type="submit">Delete Event</button>
            </form>

            <!-- Search Event Form -->
            <h3>Search Event</h3>
            <form action="index.php?action=searchEvent" method="post">
                <input type="text" name="event_name" placeholder="Event Name to Search">
                <button type="submit">Search Event</button>
            </form>

            <!-- Read All Events -->
            <h3>All Events</h3>
            <?php include('Controll/EventC.php'); ?>
        </section>

        <!-- Feedback CRUD Section -->
        <section>
            <h2>Feedback CRUD</h2>
            <!-- Create Feedback Form -->
            <h3>Create Feedback</h3>
            <form action="index.php?action=createFeedback" method="post">
                <input type="hidden" name="event_id" value="1"> <!-- Example: Hardcoded event ID -->
                <input type="text" name="candidate_name" placeholder="Your Name" required>
                <textarea name="feedback_text" placeholder="Feedback" required></textarea>
                <label for="satisfaction_rating">Satisfaction Rating:</label>
                <input type="number" name="satisfaction_rating" id="satisfaction_rating" min="1" max="5" required>
                <button type="submit">Submit Feedback</button>
            </form>

            <!-- Read All Feedback -->
            <h3>All Feedback</h3>
            <?php include('Controll/FeedbackC.php'); ?>

            <!-- Update Feedback Form -->
            <h3>Update Feedback</h3>
            <form action="index.php?action=updateFeedback" method="post">
                <input type="text" name="feedback_id" placeholder="Feedback ID to Update" required>
                <input type="text" name="candidate_name" placeholder="Your Name" required>
                <textarea name="feedback_text" placeholder="Feedback" required></textarea>
                <label for="satisfaction_rating">Satisfaction Rating:</label>
                <input type="number" name="satisfaction_rating" id="satisfaction_rating" min="1" max="5" required>
                <button type="submit">Update Feedback</button>
            </form>

            <!-- Delete Feedback Form -->
            <h3>Delete Feedback</h3>
            <form action="index.php?action=deleteFeedback" method="post">
                <input type="text" name="feedback_id" placeholder="Feedback ID to Delete" required>
                <button type="submit">Delete Feedback</button>
            </form>

            <!-- Search Feedback Form -->
            <h3>Search Feedback</h3>
            <form action="index.php?action=searchFeedback" method="post">
                <input type="text" name="candidate_name" placeholder="Your Name to Search">
                <button type="submit">Search Feedback</button>
            </form>
        </section>
    </div>
</body>
</html>
