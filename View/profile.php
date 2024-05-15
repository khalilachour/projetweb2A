<?php
session_start();

require_once "../config.php"; // Adjust the path as needed

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

try {
    $conn = config::getConnexion(); // Use the config class to get the PDO instance

    $stmt = $conn->prepare("
        SELECT user_id, username, email, password, type, NULL as nom_societe FROM Users WHERE user_id = :user_id 
        UNION 
        SELECT societe_id as user_id, NULL as username, email, password, 'societe' as type, nom_societe FROM Societes WHERE societe_id = :user_id
    ");
    $stmt->bindParam(':user_id', $_SESSION["user_id"]);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 0; 
            background-color: #f0f0f0; 
        }
        .profile-info { 
            width: 80%; 
            margin: 50px auto; 
            padding: 20px; 
            background-color: #fff; 
            border-radius: 10px; 
            box-shadow: 0 0 20px rgba(0,0,0,0.2); 
            text-align: center; 
        }
        .profile-info h1 { 
            color: #333; 
            margin-bottom: 20px; 
        }
        .profile-info p { 
            color: #666; 
            font-size: 18px; 
            margin-bottom: 10px; 
        }
        .gauge {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto;
            margin-bottom: 20px;
        }
        .gauge:before, .gauge:after, .gauge span {
            position: absolute;
            content: '';
            border-radius: 50%;
        }
        .gauge:before {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #ddd;
        }
        .gauge:after {
            top: 5%;
            left: 5%;
            width: 90%;
            height: 90%;
            background: #fff;
        }
        .gauge span {
            top: 50%;
            left: 50%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to top, dodgerblue 50%, transparent 50%);
            transform-origin: bottom;
            transform: rotate(var(--rotation));
        }
        .gauge span:before {
            top: -5%;
            left: -5%;
            width: 10%;
            height: 10%;
            background: dodgerblue;
        }
    </style>
</head>
<body>
    <div class="profile-info">
        <h1>Welcome, <?php echo isset($user["username"]) ? htmlspecialchars($user["username"]) : ''; ?>!</h1>
        <p>Email: <?php echo isset($user["email"]) ? htmlspecialchars($user["email"]) : ''; ?></p>
        <?php if (isset($user["type"]) && $user["type"] == 'societe'): ?>
            <p>Company Name: <?php echo isset($user["nom_societe"]) ? htmlspecialchars($user["nom_societe"]) : ''; ?></p>
        <?php endif; ?>
        <h2>Benefits</h2>
        <div class="gauge" style="--rotation: 0deg">
            <span style="--rotation: calc(180deg * 0.75)"></span>
        </div>
        <h2>Job Types</h2>
        <!-- Add job types here -->
    </div>
</body>
</html>


