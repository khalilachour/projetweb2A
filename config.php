<?php
// Define database connection settings
$db_host = "localhost";
$db_name = "event_feedback";
$db_user = "root"; // Change this to your actual database username
$db_password = ""; // Change this to your actual database password if it's not empty

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    
    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Define other global constants or configurations here

    // For example, you might define the base URL of your website
    define('BASE_URL', 'http://example.com');

    // Or other database related constants
    define('DB_TABLE_EVENTS', 'events');
    define('DB_TABLE_FEEDBACK', 'feedback');
    // Add more constants as needed

} catch(PDOException $e) {
    // If an error occurs, display the error message
    die("Connection failed: " . $e->getMessage());
}

