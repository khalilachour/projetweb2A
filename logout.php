<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging out...</title>
    <link rel="stylesheet" href="logout.css"> <!-- Include CSS file -->
</head>

<body>
    <div class="container">
        <div class="logout-message">
            <h1>Logging out...</h1>
        </div>
    </div>

    <?php
    session_start();
    session_destroy();
    ?>
    
    <script>
        // Wait for the animation to complete before redirecting
        setTimeout(function() {
            window.location.href = "login.php";
        }, 1000); // Adjust the delay (in milliseconds) as needed
    </script>
</body>

</html>
