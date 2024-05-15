<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Event Details</h1>

<?php
// Assuming $event contains the details of the specific event retrieved from the controller
// You can access the event details and display them here
?>

<p><strong>Event ID:</strong> <?php echo $event['event_id']; ?></p>
<p><strong>Event Name:</strong> <?php echo $event['event_name']; ?></p>
<p><strong>Event Type:</strong> <?php echo $event['event_type']; ?></p>
<p><strong>Date:</strong> <?php echo $event['event_date']; ?></p>
<p><strong>Place:</strong> <?php echo $event['event_place']; ?></p>
<p><strong>Description:</strong> <?php echo $event['event_description']; ?></p>


</body>
</html>
