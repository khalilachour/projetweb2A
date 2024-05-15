<?php

require_once 'dompdf/autoload.inc.php';
require_once 'config.php'; // Include the config file to establish database connection
use Dompdf\Dompdf;
use Dompdf\Options;

function exportTicketPurchasesToPDF($pdo) {
    // Create a new Dompdf instance
    $dompdf = new Dompdf();
    
    // Query to fetch ticket purchase details from the database
    $stmt = $pdo->prepare("SELECT * FROM ticket_purchases");
    $stmt->execute();
    $ticketPurchases = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Load HTML content for the PDF
    $html = '<!DOCTYPE html>
        <html>
        <head>
            <title>Ticket Purchases</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    position: relative; /* Ensure positioning works */
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
            <h1>Ticket Purchases</h1>
            <table>
                <thead>
                    <tr>
                        <th>Candidate Name</th>
                        <th>Event ID</th>
                        <th>Receipt</th>
                    </tr>
                </thead>
                <tbody>';
    
    // Loop through ticket purchases and add them to the table
    foreach ($ticketPurchases as $purchase) {
        $html .= '<tr>
                    <td>'.$purchase['candidate_name'].'</td>
                    <td>'.$purchase['event_id'].'</td>
                    <td>'.$purchase['receipt'].'</td>
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
    header('Content-Disposition: attachment;filename="ticket_purchases.pdf"');
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
// Call the function to export ticket purchases to PDF
exportTicketPurchasesToPDF($pdo);

