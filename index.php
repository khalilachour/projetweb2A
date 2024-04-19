<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Feedback</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Event Feedback</h1>
    
    <?php
    // Include the database connection and classes
    require_once 'database.php'; // Changed from connection.php
    require_once 'event.php';
    require_once 'feedback.php';
    require_once 'crudevent.php';
    require_once 'crudfeedback.php';

    // Check if the database connection is successful
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Create instances of CrudEvent and CrudFeedback
    $crudEvent = new CrudEvent($db);
    $crudFeedback = new CrudFeedback($db);

    // Fetch and display events
    $events = $crudEvent->readEvents();
    if ($events) {
        echo "<h2>Events</h2>";
        echo "<ul>";
        foreach ($events as $event) {
            echo "<li>{$event['eventName']} - {$event['date']} - {$event['place']}</li>";
            echo "<ul>";
            
            // Fetch and display feedback for each event
            $eventId = $event['eventId'];
            $feedbacks = $crudFeedback->readFeedback("eventId = $eventId");
            if ($feedbacks) {
                foreach ($feedbacks as $feedback) {
                    echo "<li>{$feedback['feedbackText']} - Satisfaction Rating: {$feedback['satisfactionRating']}</li>";
                }
            } else {
                echo "<li>No feedback available</li>";
            }

            echo "</ul>";
        }
        echo "</ul>";
    } else {
        echo "<p>No events available</p>";
    }
    ?>
</body>
</html>
