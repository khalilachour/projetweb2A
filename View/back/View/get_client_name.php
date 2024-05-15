<?php
// Define the database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'educatous';

// Create a new database connection
$conn = new mysqli($host, $username, $password, $database);

// Check for errors
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

// Connect to the database
// ...

// Get the name of the client who made the latest complaint
$query = "SELECT nom_client FROM reclamation ORDER BY id_rec DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$clientName = $row['nom_client'];

// Return the client name as a JSON object
echo json_encode(['clientName' => $clientName]);
?>