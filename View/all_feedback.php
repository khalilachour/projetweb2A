<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Feedback</title>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>All Feedback</h1>
    <table>
        <thead>
            <tr>
                <th>Event ID</th>
                <th>Candidate Name</th>
                <th>Feedback Text</th>
                <th>Satisfaction Rating</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($feedbacks as $feedback): ?>
                <tr>
                    <td><?php echo $feedback['event_id']; ?></td>
                    <td><?php echo $feedback['candidate_name']; ?></td>
                    <td><?php echo $feedback['feedback_text']; ?></td>
                    <td><?php echo $feedback['satisfaction_rating']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
