
<?php
require_once "../Controller/UserC.php";
require_once "../Model/User.php";
require_once "../config.php";
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the userId is set in the POST request
    if (isset($_POST['user_id'])) {
        // Retrieve the userId from the POST data
        $userId = $_POST['user_id'];

        // Include the necessary files and initialize your UserController
        require_once __DIR__ . '/../Controller/UserC.php';
        $userC = new UserController();

        // Call the method to delete the user
        $deleteResult = $userC->deleteUser($userId);

        // Check the result of the deletion operation
        if ($deleteResult) {
            // Redirect to the layout-static.php page
            header("Location: /projet/View/back/layout-static.php");
            exit(); // Ensure script termination after redirection
        } else {
            // Handle the case where deletion failed
            echo "Failed to delete user.";
        }
    } else {
        // Handle the case where userId is not set in the POST request
        echo "User ID is missing.";
    }
} else {
    // Handle the case where the request method is not POST
    echo "Invalid request method.";
}
?>

