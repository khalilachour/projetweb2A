<?php
// Prevent the browser from caching the page
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set in the POST request
    if (isset($_POST['email'], $_POST['username'], $_POST['password'], $_POST['type'], $_POST['age'], $_POST['localisation'])) {
        // Retrieve form data from the POST request
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $type = $_POST['type'];
        $age = $_POST['age'];
        $localisation = $_POST['localisation'];

        // Include necessary files and initialize database connection
        require_once "../Controllers/UserC.php";
        require_once "../Models/User.php";
        require_once "../config.php";
        $userC = new UserController();

        // Check if the email exists in the database
        if ($userC->isEmailExists($email)) {
            // Display error message if email already exists
            echo '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; border-radius: 5px;">';
            echo 'This email is already taken.';
            echo '</div>';
        } else {
            // Add the user only if the email is not in the database
            $user = new User($username, $email, $password, $type, $age, $localisation);
            $userC->createUser($username, $email, $password, $type, $age, $localisation);

            // Redirect to another page if necessary
            header("Location: contact.php");
            exit(); // Ensure that the script terminates after redirection
        }
    } else {
        // Handle case where form fields are not set in the POST request
        echo "Missing form fields.";
    }
} else {
    // Handle case where request method is not POST
    echo "Invalid request method.";
}
?>

<!-- Add User Form -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="section-title position-relative text-center mb-5 pb-2">
                <h6 class="position-relative d-inline text-primary ps-4">Add User</h6>
                <h2 class="mt-2">Enter User Details</h2>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                            <label for="username">Username</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <select id="type" name="type" class="form-select">
                                <option value="normal">Normal</option>
                                <option value="admin">Admin</option>
                            </select>
                            <label for="type">Type</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="age" name="age" placeholder="Age">
                            <label for="age">Age</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="localisation" name="localisation" placeholder="Localisation">
                            <label for="localisation">Localisation</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">Add User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
