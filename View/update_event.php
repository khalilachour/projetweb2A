<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form action="update_event.php" method="post">
    <!-- Form fields pre-populated with current event details -->
    <input type="text" name="event_name" value="<?php echo $event['event_name']; ?>">
    <input type="text" name="event_type" value="<?php echo $event['event_type']; ?>">
    <!-- Other event details -->
    <input type="date" name="event_date" value="<?php echo $event['event_date']; ?>">
    <input type="text" name="event_place" value="<?php echo $event['event_place']; ?>">
    <textarea name="event_description"><?php echo $event['event_description']; ?></textarea>
    <!-- Other event details -->

    <button type="submit">Update Event</button>
</form>

</body>
</html>
