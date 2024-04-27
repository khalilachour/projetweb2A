<?php
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
$username = isset($_POST['username']) ? $_POST['username'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$type = isset($_POST['type']) ? $_POST['type'] : '';
$age = isset($_POST['age']) ? $_POST['age'] : '';
$localisation = isset($_POST['localisation']) ? $_POST['localisation'] : '';
// Add a user only if all values are defined
if(!empty($username) && !empty($email) && !empty($password) && !empty($type) && !empty($age) && !empty($localisation) && !$userC->isEmailExists($email)  ) {
    // Add the user with the values of POST parameters
    $user = new User($username, $email, $password, $type, $age, $localisation);
    $userC->createUser($username, $email, $password, $type, $age, $localisation);
    // Redirect to another page if necessary
    header("Location: contact.php");
} 
?>
