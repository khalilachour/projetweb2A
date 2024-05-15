<?php

require_once 'dompdf/autoload.inc.php';
require_once 'config.php'; // Include the config file to establish database connection
use Dompdf\Dompdf;
use Dompdf\Options;

function exportEventsToPDF($pdo) {
    // Create a new Dompdf instance
    $dompdf = new Dompdf();
    
    // Query to fetch event details from the database
    $stmt = $pdo->prepare("SELECT * FROM events");
    $stmt->execute();
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Load HTML content for the PDF
    $html = '<!DOCTYPE html>
        <html>
        <head>
            <title>Event Details</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    position: relative; /* Ensure positioning works */
                }
                .logo {
                    position: absolute;
                    top: 20px;
                    right: 20px; /* Positioning the logo to the upper right corner */
                    width: 100px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid #000;
                    padding: 8px;
                }
            </style>
        </head>
        <body>
        <img src="logo.png" class="logo" alt="Logo">

            <h1>Event Details</h1>
            <table>
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Event Type</th>
                        <th>Event Date</th>
                        <th>Event Place</th>
                        <th>Event Description</th>
                        <th>Ticket Price</th>
                        <th>Ticket Number</th>
                    </tr>
                </thead>
                <tbody>';
    
    // Loop through events and add them to the table
    foreach ($events as $event) {
        $html .= '<tr>
                    <td>'.$event['event_name'].'</td>
                    <td>'.$event['event_type'].'</td>
                    <td>'.$event['event_date'].'</td>
                    <td>'.$event['event_place'].'</td>
                    <td>'.$event['event_description'].'</td>
                    <td>'.$event['ticket_price'].'</td>
                    <td>'.$event['ticket_number'].'</td>
                </tr>';
    }
    
    // Close HTML content
    $html .= '</tbody></table></body></html>';
    
    // Load HTML into Dompdf
    $dompdf->loadHtml($html);
    
    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');
    
    // Render the HTML as PDF
    $dompdf->render();
    
    // Get the PDF content as a string
    $pdfContent = $dompdf->output();
    
    // Set headers for force download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment;filename="event_details.pdf"');
    header('Cache-Control: private, max-age=0, must-revalidate');
    header('Pragma: public');
    
    // Output the PDF content
    echo $pdfContent;
    exit();
}

// Create a PDO connection
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: Could not connect. " . $e->getMessage());
}

// Usage example:
// Call the function to export events to PDF
exportEventsToPDF($pdo);

