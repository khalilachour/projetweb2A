<?php
// Prevent the browser from caching the page
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Include necessary files
include '../Controller/CompanyC.php';
require_once "../Model/Company.php";
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
    $successMessage = "Successfully added to the database!";

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Creation</title>
    <style>
        .success-message {
            background-color: #dff0d8;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            text-align: center;
            font-family: Arial, sans-serif;
            font-size: 20px;
            animation: fadeout 2s 4s forwards;
        }
        @keyframes fadeout {
            from {opacity: 1;}
            to {opacity: 0;}
        }
    </style>
</head>
<body>
    <!-- Display success message if set -->
    <?php if(!empty($successMessage)): ?>
        <div class="success-message">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?>
    <script>
        // Delayed redirection after 3 seconds
        setTimeout(function(){
            window.location.href = 'login_view.php'; // Redirect to the same page
        }, 3000);
    </script>
</body>
</html>


