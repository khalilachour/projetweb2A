<?php

// Adjust the paths based on the current file location
include_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Controllers/CompanyC.php';

// Create an instance of the CompanyC class
$companyController = new CompanyC();

// Fetch company types
$companyTypes = $companyController->getCompanyTypes();

// Initialize an empty array to store company type data
$companyTypeData = [];

// Iterate over each company type and count the number of companies for each type
foreach ($companyTypes as $type) {
    $count = $companyController->getCompanyCountByType($type);
    // Store the count in the companyTypeData array with the type as key
    $companyTypeData[$type] = $count;
}

// Return the companyTypeData array as JSON response
echo json_encode($companyTypeData);
?>