<?php
// Start the session
session_start();

// Prevent the browser from caching the page
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Include necessary files
require_once "../Controllers/UserC.php";
require_once "../Models/User.php";
require_once "../config.php";

// Instantiate the UserC class
$userC = new UserController(); 

// Retrieve the values of POST parameters
$username = isset($_POST['add_u_username']) ? $_POST['add_u_username'] : '';
$email = isset($_POST['add_u_email']) ? $_POST['add_u_email'] : '';
$password = isset($_POST['add_u_password']) ? $_POST['add_u_password'] : '';
$type = isset($_POST['add_u_type']) ? $_POST['add_u_type'] : '';
$age = isset($_POST['add_u_age']) ? $_POST['add_u_age'] : '';
$localisation = isset($_POST['add_u_localisation']) ? $_POST['add_u_localisation'] : '';

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$successMessage = '';

// Add a user only if all values are defined
if(!empty($username) && !empty($email) && !empty($password) && !empty($type) && !empty($age) && !empty($localisation) && !$userC->isEmailExists($email)  ) {
    // Add the user with the values of POST parameters
    $user = new User($username, $email, $hashed_password, $type, $age, $localisation);
    $userC->createUser($username, $email, $hashed_password, $type, $age, $localisation);
    // Set success message in session
    // Redirect to another page if necessary
    $successMessage = "Successfully added to the database!";
} 
?>
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




