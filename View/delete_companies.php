<?php
// Include necessary files
include '../Controller/CompanyC.php';
require_once "../Model/Company.php";
require_once '../config.php';
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the companyId is set in the POST request
    if (isset($_POST['companyId'])) {
        // Retrieve the companyId from the POST data
        $companyId = $_POST['companyId'];

        // Include the necessary files and initialize your database connection
        include_once __DIR__ . '/../Controller/CompanyC.php';
        $companyC = new CompanyC();

        // Call the method to delete the company
        $deleteResult = $companyC->deleteCompany($companyId);
        header("Location: /../projet/View/back/layout-static.php");

        // Check the result of the deletion operation
        if ($deleteResult) {
            // Redirect to the contact.php page
            exit(); // Ensure script termination after redirection
        } 
    } else {
        // Handle the case where companyId is not set in the POST request
        echo "Company ID is missing.";
    }
} else {
    // Handle the case where the request method is not POST
    echo "Invalid request method.";
}
?>
