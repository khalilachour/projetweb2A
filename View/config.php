<?php

$db_host = "localhost";
$db_name = "event_feedback";
$db_user = "root"; 
$db_password = ""; 

try {
    
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    
  
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    define('BASE_URL', 'http://example.com');

    define('DB_TABLE_EVENTS', 'events');
    define('DB_TABLE_FEEDBACK', 'feedback');
    define('DB_TABLE_TICKET_PURCHASES', 'ticket_purchases');
    

} catch(PDOException $e) {
    
    die("Connection failed: " . $e->getMessage());
}

