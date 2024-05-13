<?php
// Check if the user is logged in and not an admin
if (isset($_SESSION['user_email']) && $_SESSION['user_type'] !== 'admin') {
    // Retrieve user data from session
    $email = $_SESSION['user_email'];
    $username = $_SESSION['user_username'];
    $type = $_SESSION['user_type'];
    $age = $_SESSION['user_age'];
    $localisation = $_SESSION['user_localisation'];

    // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if all form fields are set in the POST request
        if (isset($_POST['username'], $_POST['type'], $_POST['age'], $_POST['localisation'])) {
            // Retrieve form data from the POST request
            $username = $_POST['username'];
            $type = $_POST['type'];
            $age = $_POST['age'];
            $localisation = $_POST['localisation'];

            // Include necessary files and initialize database connection
            require_once "../Controller/UserC.php";
            require_once "../Model/User.php";
            require_once "../config.php";
            $userC = new UserController();

            // Call the method to update user details by email
            $updateResult = $userC->updateUserByEmail($email, $username, $type, $age, $localisation);

            // Check the result of the update operation
            if ($updateResult) {
                // Redirect to another page if necessary
                header("Location: contact.php");
                exit(); // Ensure that the script terminates after redirection
            } else {
                echo "Failed to update user. Please try again.";
            }
        } else {
            // Handle case where form fields are not set in the POST request
            echo "Missing form fields.";
        }
    }
} else {
    // Redirect to login page or handle unauthorized access
    header("Location: contact.php");
    exit();
}
?>
