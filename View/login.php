<?php
session_start();

require_once "../config.php"; // Adjust the path as needed

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    try {
        $conn = config::getConnexion(); // Use the config class to get the PDO instance

        $stmt = $conn->prepare("
            SELECT user_id, username, email, password, type FROM Users WHERE email = :email 
            UNION 
            SELECT societe_id, nom_societe, email, password, 'societe' as type FROM Societes WHERE email = :email
        ");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // In your login script
    if ($user) {
        // Check if the provided password matches the hashed password
        if (password_verify($password, $user["password"])) {
            // Store user information in session
            $_SESSION["user_id"] = $user["user_id"]; // Store user ID
            $_SESSION["username_up"] = $user["username"]; // Store username
            $_SESSION["user_email"] = $user["email"]; // Store email
            $_SESSION["user_type"] = $user["type"]; // Store user type

            // If the user is a company, store company name
            if ($user["type"] == 'societe') {
                $_SESSION["company"] = $user["nom_societe"]; // Store company name
            }

            // Redirect to the appropriate page
            if ($user['type'] == 'admin') {
                header("Location: back/layout-static.php");
            } else if ($user['type'] == 'societe') {
                header("Location: afficher.php");
            } else {
                header("Location: afficheru.php");
            }
            exit(); // Exit after redirection
        } else {
            echo "<div class='alert alert-danger'>Wrong password</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Email does not exist</div>";
    }

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
