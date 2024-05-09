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
    
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Profile Edit Data and Skills</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    body {
        background: #f7f7ff;
        margin-top:20px;
    }
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid transparent;
        border-radius: .25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    }
    .me-2 {
        margin-right: .5rem!important;
    }
</style>
</head>
<body>
<div class="container">
    <div class="main-body">
        <!-- Rest of your HTML here -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                            <div class="mt-3">
                                <h4><?php
echo isset($user["username"]) ? htmlspecialchars($user["username"]) : '';
?></h4>
                                <p class="text-secondary mb-1"><?php
echo isset($user["type"]) ? htmlspecialchars($user["type"]) : '';
?></p>
                                <p class="text-muted font-size-sm"><?php
echo isset($user["email"]) ? htmlspecialchars($user["email"]) : '';
?></p>
                                <button class="btn btn-primary">Follow</button>
                                <button class="btn btn-outline-primary">Message</button>
                            </div>
                        </div>
                        <hr class="my-4">
                        <ul class="list-group list-group-flush">
                            <!-- Add your social media links here -->
                        </ul>
                    </div>
                </div>
                <?php
// Include necessary files and initialize the database connection
include_once __DIR__ . '/../Controllers/CompanyC.php';
include_once __DIR__ . '/../Controllers/UserC.php';

$companyC = new CompanyC();
$userC    = new UserController();

// Fetch the company details
$company = $companyC->getCompanyByEmail($_SESSION['user_email']);
// Fetch the user details
$user    = $userC->getUserByEmail($_SESSION['user_email']);
?>

<!-- Company form -->
<?php
if ($company):
?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <form method="post" action="update_companies.php">
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" value="<?php
    echo $company['email'];
?>"><br>
                    <label for="nom_societe">Company Name:</label><br>
                    <input type="text" id="nom_societe" name="nom_societe" value="<?php
    echo $company['nom_societe'];
?>"><br>
                    <label for="numero">Number:</label><br>
                    <input type="text" id="numero" name="numero" value="<?php
    echo $company['numero'];
?>"><br>
                    <label for="capital">Capital:</label><br>
                    <input type="text" id="capital" name="capital" value="<?php
    echo $company['capital'];
?>"><br>
                    <label for="localisation">Location:</label><br>
                    <input type="text" id="localisation" name="localisation" value="<?php
    echo $company['localisation'];
?>"><br>
                    <input type="submit" value="Update" class="btn btn-primary mt-3">
                </form>
            </div>
        </div>
    </div>
    <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="d-flex align-items-center mb-3">Project Status</h5>
                                <p>Web Design</p>
                                <div class="progress mb-3" style="height: 5px">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p>Website Markup</p>
                                <div class="progress mb-3" style="height: 5px">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p>One Page</p>
                                <div class="progress mb-3" style="height: 5px">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p>Mobile Template</p>
                                <div class="progress mb-3" style="height: 5px">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p>Backend API</p>
                                <div class="progress" style="height: 5px">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php
endif;
?>
            </div>

    </div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
</body>
</html>