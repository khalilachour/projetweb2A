<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<p>Are you sure you want to delete this event?</p>
<a href="delete_event.php?event_id=<?php echo $eventId; ?>" class="delete-link">Yes</a>
<a href="view_event.php?event_id=<?php echo $eventId; ?>" class="cancel-link">No</a>

</body>
</html>
