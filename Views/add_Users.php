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
if(!empty($username) && !empty($email) && !empty($password) && !empty($type) && !empty($age) && !empty($localisation) ) {
    // Add the user with the values of POST parameters
    $user = new User($username, $email, $password, $type, $age, $localisation);
    $userC->createUser($username, $email, $password, $type, $age, $localisation);
    // Redirect to another page if necessary
    header("Location: contact.php");
    exit();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
</head>
<body>
    <h2>Add User</h2>
    <form action="add_Users.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="type">Type:</label><br>
        <select id="type" name="type" required>
            <option value="normal">Normal</option>
            <option value="admin">Admin</option>
        </select><br><br>
        
        <label for="age">Age:</label><br>
        <input type="number" id="age" name="age" required><br><br>
        
        <label for="localisation">Localisation:</label><br>
        <input type="text" id="localisation" name="localisation" required><br><br>
        
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
