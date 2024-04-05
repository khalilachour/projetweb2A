<?php
// Include database connection and configuration
$host = 'localhost';
$username = 'your_username';
$password = 'your_password';
$database = 'your_database';
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Include class files
include 'crudEvent.php';
include 'event.php';
include 'crudFeedback.php';
include 'feedback.php';

// Instantiate classes
$crudEvent = new CrudEvent($conn);
$crudFeedback = new CrudFeedback($conn);

// Process form submission for adding a new recruitment event
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eventName"]) && isset($_POST["eventType"]) && isset($_POST["date"]) && isset($_POST["location"]) && isset($_POST["description"])) {
    $eventName = $_POST["eventName"];
    $eventType = $_POST["eventType"];
    $date = $_POST["date"];
    $location = $_POST["location"];
    $description = $_POST["description"];

    $result = $crudEvent->createRecruitmentEvent($eventName, $eventType, $date, $location, $description);
    echo "<p>$result</p>";
}

// Process form submission for providing feedback
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["candidateID"]) && isset($_POST["feedbackText"]) && isset($_POST["rating"])) {
    $candidateID = $_POST["candidateID"];
    $feedbackText = $_POST["feedbackText"];
    $rating = $_POST["rating"];

    $result = $crudFeedback->createRecruitmentFeedback($candidateID, $feedbackText);
    echo "<p>$result</p>";

    // Get the ID of the last inserted feedback
    $feedbackID = $conn->insert_id;

    // Provide rating for the feedback
    $feedback = new Feedback($feedbackText);
    $result = $feedback->provideRating($feedbackID, $rating, $conn);
    echo "<p>$result</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruitment System</title>
</head>
<body>
    <h1>Add New Recruitment Event</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="eventName">Event Name:</label>
        <input type="text" id="eventName" name="eventName" required><br><br>
        <label for="eventType">Event Type:</label>
        <input type="text" id="eventType" name="eventType" required><br><br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>
        <input type="submit" value="Add Event">
    </form>

    <h1>Provide Feedback</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="candidateID">Candidate ID:</label>
        <input type="text" id="candidateID" name="candidateID" required><br><br>
        <label for="feedbackText">Feedback Text:</label><br>
        <textarea id="feedbackText" name="feedbackText" rows="4" cols="50" required></textarea><br><br>
        <label for="rating">Rating:</label>
        <select id="rating" name="rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select><br><br>
        <input type="submit" value="Provide Feedback">
    </form>
</body>
</html>
