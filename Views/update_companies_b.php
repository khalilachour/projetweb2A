<?php
// Prevent the browser from caching the page
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Include necessary files
include '../Controllers/CompanyC.php';
require_once "../Models/Company.php";
require_once '../config.php';

// Instantiate the CompanyC class
$companyC = new CompanyC(); 

// Retrieve the values of POST parameters
$nom = isset($_POST['nom_societe']) ? $_POST['nom_societe'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$numero = isset($_POST['numero']) ? $_POST['numero'] : '';
$capital = isset($_POST['capital']) ? $_POST['capital'] : '';
$localisation = isset($_POST['localisation']) ? $_POST['localisation'] : '';

// Update a company only if all values are defined
if(!empty($nom) && !empty($email) && !empty($numero) && !empty($capital) && !empty($localisation)) {
    // Update the company with the values of POST parameters
    $company = new Company($nom, $email, $numero, $capital, $localisation);
    $companyC->updateCompanyByEmail($email, $company);

    // Redirect to another page if necessary
    header("Location: layout-static.php");
} 
?>
