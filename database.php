<?php
// Database configuration
$servername = "localhost"; // Change this to your database server name if different
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password if set
$dbname = "event_feedback"; // Change this to your database name

// Create database connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Set charset to utf8
$db->set_charset("utf8");
?>
