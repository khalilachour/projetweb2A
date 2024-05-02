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
$nom = isset($_POST['add_c_nom']) ? $_POST['add_c_nom'] : '';
$email = isset($_POST['add_c_email']) ? $_POST['add_c_email'] : '';
$password = isset($_POST['add_c_password']) ? $_POST['add_c_password'] : '';
$type = isset($_POST['add_c_type']) ? $_POST['add_c_type'] : '';
$numero = isset($_POST['add_c_numero']) ? $_POST['add_c_numero'] : '';
$capital = isset($_POST['add_c_capital']) ? $_POST['add_c_capital'] : '';
$localisation = isset($_POST['add_c_localisation']) ? $_POST['add_c_localisation'] : '';

// Add a company only if all values are defined
if(!empty($nom) && !empty($email) && !empty($password) && !empty($type) && !empty($numero) && !empty($capital) && !empty($localisation) && !$companyC->isEmailExists($email) ) {
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Add the company with the values of POST parameters
    $company = new Company($nom, $email, $hashedPassword, $type, $numero, $capital, $localisation);
    $companyC->addCompany($company);
    // Redirect to another page if necessary
    header("Location: login_views.php");
    $_SESSION['welcome_message'] = true;

    // header('location:listCompanies.php');
} 
?>
<!-- Welcome message -->
<?php if (isset($_SESSION['welcome_message']) && $_SESSION['welcome_message']): ?>
    <div style="background-color: #d4edda; color: #155724; padding: 20px; border-radius: 5px; margin: 20px 0;">
        <h2>Welcome, <?php echo "Bienvenue Societe"; ?>!</h2>
        <p>Your account has been created successfully. We're glad to have you on board.</p>
    </div>
    <?php $_SESSION['welcome_message'] = false; ?>
<?php endif; ?>

