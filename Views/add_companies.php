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
$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$type = isset($_POST['type']) ? $_POST['type'] : '';
$numero = isset($_POST['numero']) ? $_POST['numero'] : '';
$capital = isset($_POST['capital']) ? $_POST['capital'] : '';
$localisation = isset($_POST['localisation']) ? $_POST['localisation'] : '';

// Add a company only if all values are defined
if(!empty($nom) && !empty($email) && !empty($password) && !empty($type) && !empty($numero) && !empty($capital) && !empty($localisation) && !$companyC->isEmailExists($email) ) {
    // Add the company with the values of POST parameters
    $company = new Company($nom, $email, $password, $type, $numero, $capital, $localisation);
    $companyC->addCompany($company);
    // Redirect to another page if necessary
    header('location : ../contact.php');

    // header('location:listCompanies.php');
} 
?>
