<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit(); // Ensure to exit the script after redirection.
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css"> <!-- Include CSS file -->
    <style>
        /* Inline styles for this page only */
        body {
            background-color: #f5f5f5; /* Light gray background */
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Subtle box shadow */
            background-color: #fff; /* White background */
            border-radius: 10px; /* Rounded corners */
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd; /* Light gray border */
            border-radius: 5px; /* Rounded corners */
        }

        .form-btn {
            text-align: center;
        }

        .btn-primary {
            background-color: #007bff; /* Blue button color */
            color: #fff; /* White text color */
            border: none;
            padding: 10px 20px;
            border-radius: 5px; /* Rounded corners */
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .error-message {
            color: #dc3545; /* Red color for error messages */
            margin-top: 10px;
        }

        .link {
            text-align: center;
            margin-top: 20px;
        }

        .link a {
            color: #007bff; /* Blue link color */
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
</head>

<body>

    <div class="container">
        <?php

        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    $_SESSION["user"] = $user; // Store user data in session
                    header("location: index.php");
                    exit(); // Ensure to exit the script after redirection.
                } else {
                    echo "<div class='alert alert-danger'>Wrong password</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email does not exist</div>";
            }
        }

        ?>


        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <div class="link">
            <p>Not registered yet? <a href="registration.php">Register Here</a></p>
        </div>
    </div>

</body>

</html>
