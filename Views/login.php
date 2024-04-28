<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit(); // Exit to prevent further execution
}

require_once "../config.php"; // Adjust the path as needed
$config = array(
    'servername' => 'localhost',
    'username' => 'root',
    'password' => '',
    'dbname' => 'baseuser'
);
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    try {
        $conn = new PDO("mysql:host=" . $config['servername'] . ";dbname=" . $config['dbname'], $config['username'], $config['password']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("
            SELECT user_id, username, email, password FROM Users WHERE email = :email 
            UNION 
            SELECT societe_id, nom_societe, email, password FROM Societes WHERE email = :email
        ");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Check if the provided password matches the hashed password
            if (password_verify($password, $user["password"])) {
                $_SESSION["user"] = "yes";
                header("Location: contact.php");
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="text" placeholder="Enter Email:" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control">
            </div>
            <div class="for-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <div>
            <p>Not registered yet <a href="../projetweb2/Views/contact.php">Register Here</a></p>
        </div>
    </div>

</body>
</html>
