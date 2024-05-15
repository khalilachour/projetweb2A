<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Event Results</title>
    
</head>
<body>
    <h1>Search Event Results</h1>
    <?php if (empty($events)): ?>
        <p>No events found with the specified name.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($events as $event): ?>
                <li>
                    <strong>Event Name:</strong> <?php echo $event['event_name']; ?><br>
                    <strong>Event Type:</strong> <?php echo $event['event_type']; ?><br>
                    <strong>Event Date:</strong> <?php echo $event['event_date']; ?><br>
                    
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
   
</body>
</html>
