<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form action="create_event.php" method="post">
  
    <input type="hidden" name="event_id" value="">

   
    <input type="text" name="event_name" placeholder="Event Name" required>
    <input type="text" name="event_type" placeholder="Event Type" required>
    <input type="date" name="event_date" required> 
    <input type="text" name="event_place" placeholder="Event Place" required>
    <textarea name="event_description" placeholder="Event Description" required></textarea>
   

    <button type="submit">Create Event</button>
</form>

</body>
</html>
