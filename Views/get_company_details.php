<?php
// Include the necessary files and initialize the database connection

include __DIR__ . '/../config.php';
require_once __DIR__ . '/../models/Company.php';
// Check if the email parameter is provided
if(isset($_GET['email'])) {
    $email = $_GET['email'];

    // Include the CompanyC.php file to access the getCompany function
    include_once __DIR__ . '/../Controllers/CompanyC.php';
    $companyC = new CompanyC();

    // Fetch company details based on the provided email
    $company = $companyC->getCompanyByEmail($email);

    // Return company details as JSON response
    echo json_encode($company);
} else {
    // If email parameter is not provided, return an error message
    echo json_encode(array('error' => 'Email parameter is missing'));
}
?>
