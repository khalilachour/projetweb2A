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
include_once __DIR__ . '/../Controller/CompanyC.php';
include_once __DIR__ . '/../Controller/UserC.php';

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
    <?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projet/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/projet/Controller/offresC.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/projet/Controller/avantagesC.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/projet/Controller/historiqueC.php';

// Instancier les contrôleurs
$offresC = new offresC();
$avantagesC = new avantagesC();
$historiqueC = new historiqueModificationsC();

// Définir le nombre d'éléments par page
$elementsParPage = 10;

// Obtenir le numéro de page actuel pour les offres et l'historique
$pageActuelleOffres = isset($_GET['page_offres']) ? (int)$_GET['page_offres'] : 1;
$pageActuelleHistorique = isset($_GET['page_historique']) ? (int)$_GET['page_historique'] : 1;

// Calculer le décalage (offset)
$offsetOffres = ($pageActuelleOffres - 1) * $elementsParPage;
$offsetHistorique = ($pageActuelleHistorique - 1) * $elementsParPage;

// Récupérer les offres et l'historique avec pagination
$offres = $offresC->afficherAvecPagination($elementsParPage, $offsetOffres);
$historique = $historiqueC->obtenirHistoriqueAvecPagination($elementsParPage, $offsetHistorique);

// Traiter les modifications soumises par formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];

    // Récupérer les anciennes données de l'offre
    $ancienneOffre = $offresC->getOffreById($id); // Vérifiez que cette méthode existe
    $donneesOffre = [
        'nomRecruteur' => htmlspecialchars($_POST['nomRecruteur']),
        'nomSociete' => htmlspecialchars($_POST['nomSociete']),
        'titrePoste' => htmlspecialchars($_POST['titrePoste']),
        'description' => htmlspecialchars($_POST['description']),
        'lieu' => htmlspecialchars($_POST['lieu']),
        'date' => htmlspecialchars($_POST['date']),
        'salaire' => (float)htmlspecialchars($_POST['salaire']),
        'typeContrat' => htmlspecialchars($_POST['typeContrat']),
        'competencesRequises' => htmlspecialchars($_POST['competencesRequises']),
        'experience' => (int)htmlspecialchars($_POST['experience']),
    ];

    // Modifier l'offre et enregistrer l'historique
    $offresC->modifierOffre($id, $donneesOffre);
    $historiqueC->enregistrerHistoriqueModification(
        $id,
        json_encode($ancienneOffre),
        json_encode($donneesOffre)
    );

    // Récupérer l'ancien avantage, s'il existe
    $ancienAvantage = $avantagesC->getAvantageByOffreId($id);

    // Si des données d'avantages sont présentes
    if (isset($_POST['descriptionAvantage'])) {
        $donneesAvantage = [
            'description' => htmlspecialchars($_POST['descriptionAvantage']),
            'avantagesSociaux' => htmlspecialchars($_POST['avantagesSociaux']),
            'avantagesFinanciers' => htmlspecialchars($_POST['avantagesFinanciers']),
            'developpementProfessionnel' => isset($_POST['developpementProfessionnel']) ? true : false,
        ];

        // Modifier les avantages associés à l'offre et enregistrer l'historique
        if ($ancienAvantage) {
            $avantagesC->modifierAvantageParOffre($id, $donneesAvantage);
            $historiqueC->enregistrerHistoriqueModification(
                $id,
                json_encode($ancienAvantage),
                json_encode($donneesAvantage)
            );
        } 
    }

    echo "Modifications enregistrées avec succès.";
}


// Template HTML
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Charts - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand -->
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <!-- Sidebar Toggle -->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar -->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div class="container mt-5">
        <h2>Liste des Offres d'Emploi</h2>

        <!-- Table pour afficher les offres avec formulaires de modification -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du Recruteur</th>
                    <th>Nom de la Société</th>
                    <th>Titre du Poste</th>
                    <th>Description</th>
                    <th>Lieu</th>
                    <th>Date</th>
                    <th>Salaire</th>
                    <th>Type de Contrat</th>
                    <th>Compétences Requises</th>
                    <th>Expérience</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($offres as $offre) {
                    $avantage = $avantagesC->getAvantageByOffreId($offre['id']);
                ?>
                    <tr>
                        <form method="post">
                            <td><?= htmlspecialchars($offre['id']) ?></td>
                            <td><input type="text" name="nomRecruteur" value="<?= htmlspecialchars($offre['nomRecruteur']) ?>"></td>
                            <td><input type="text" name="nomSociete" value="<?= htmlspecialchars($offre['nomSociete']) ?>"></td>
                            <td><input type="text" name="titrePoste" value="<?= htmlspecialchars($offre['titrePoste']) ?>"></td>
                            <td><input type="text" name="description" value="<?= htmlspecialchars($offre['description']) ?>"></td>
                            <td><input type="text" name="lieu" value="<?= htmlspecialchars($offre['lieu']) ?>"></td>
                            <td><input type="date" name="date" value="<?= htmlspecialchars($offre['date']) ?>"></td>
                            <td><input type="number" name="salaire" value="<?= (float)htmlspecialchars($offre['salaire']) ?>"></td>
                            <td><input type="text" name="typeContrat" value="<?= htmlspecialchars($offre['typeContrat']) ?>"></td>
                            <td><input type="text" name="competencesRequises" value="<?= htmlspecialchars($offre['competencesRequises']) ?>"></td>
                            <td><input type="text" name="experience" value="<?= (int)htmlspecialchars($offre['experience']) ?>"></td>

                            <!-- Modification des avantages associés -->
                            <td>
                                <?php if ($avantage): ?>
                                    <input type="text" name="descriptionAvantage" value="<?= htmlspecialchars($avantage->getDescription()) ?>">
                                    <input type="text" name="avantagesSociaux" value="<?= htmlspecialchars($avantage->getAvantagesSociaux()) ?>">
                                    <input type="text" name="avantagesFinanciers" value="<?= htmlspecialchars($avantage->getAvantagesFinanciers()) ?>">
                                    <input type="checkbox" name="developpementProfessionnel" <?php if ($avantage->getDeveloppementProfessionnel()) echo 'checked'; ?> />
                                    <label for="developpementProfessionnel">Développement Professionnel</label>
                                <?php else: ?>
                                    <h4>Pas d'avantages associés à cette offre.</h4>
                                <?php endif; ?>
                            </td>

                            <!-- Bouton de soumission -->
                            <td>
                                <input type="hidden" name="id" value="<?= htmlspecialchars($offre['id']) ?>">
                                <button type="submit" class="btn btn-success">Valider</button>
                            </td>
                        </form>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <h2>Historique des modifications</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Anciennes Données</th>
                    <th>Nouvelles Données</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($historique as $entry) {
                    $date = isset($entry['date_modification']) ? htmlspecialchars($entry['date_modification']) : 'N/A';
                    $anciennes_donnees = isset($entry['anciennes_donnees']) ? htmlspecialchars($entry['anciennes_donnees']) : '{}';
                    $nouvelles_donnees = isset($entry['nouvelles_donnees']) ? htmlspecialchars($entry['nouvelles_donnees']) : '{}';
                ?>
                    <tr>
                        <td><?= $date ?></td>
                        <td><?= $anciennes_donnees ?></td>
                        <td><?= $nouvelles_donnees ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Autres scripts nécessaires pour votre page -->
</body>
</html>
<?php
// Inclure les dépendances nécessaires
require_once '../config.php';
require_once '../Model/offres.php';
require_once '../Controller/offresC.php';
require_once '../Controller/avantagesC.php';

// Instancier les contrôleurs
$offresC = new offresC();
$avantagesC = new avantagesC(); // Contrôleur pour les avantages

// Si le formulaire de suppression est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
    // Obtenir l'identifiant de l'offre à supprimer
    $offreId = (int)$_POST['id'];

    // Commencer une transaction pour garantir l'intégrité des données
    $db = config::getConnexion();

    try {
        $db->beginTransaction(); // Démarrer une transaction

        // Supprimer les avantages associés à l'offre
        $avantagesC->supprimerAvantagesParOffre($offreId);

        // Supprimer l'offre elle-même
        $offresC->supprimerOffre($offreId);

        // Confirmer la transaction
        $db->commit();

        // Rediriger vers la même page pour rafraîchir la liste
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;

    } catch (Exception $e) {
        // Si une erreur survient, annuler la transaction
        $db->rollBack();
        echo "Erreur lors de la suppression de l'offre et des avantages associés : " . $e->getMessage();
    }
}

// Récupérer toutes les offres d'emploi
$offres = $offresC->listOffres(); // Fonction pour lister toutes les offres
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Offres</title>
    <!-- Inclure Bootstrap pour le style -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Liste des Offres d'Emploi</h2>

        <!-- Table pour afficher les offres avec formulaires de suppression -->
        <table class="table table-striped"> <!-- Tableau stylisé avec Bootstrap -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du Recruteur</th>
                    <th>Nom de la Société</th>
                    <th>Titre du Poste</th>
                    <th>Description</th>
                    <th>Lieu</th>
                    <th>Date</th>
                    <th>Salaire</th>
                    <th>Type de Contrat</th>
                    <th>Compétences Requises</th>
                    <th>Expérience</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Afficher toutes les offres -->
                <?php foreach ($offres as $offre) : ?>
                    <tr>
                        <td><?= htmlspecialchars($offre['id']) ?></td>
                        <td><?= htmlspecialchars($offre['nomRecruteur']) ?></td>
                        <td><?= htmlspecialchars($offre['nomSociete']) ?></td>
                        <td><?= htmlspecialchars($offre['titrePoste']) ?></td>
                        <td><?= htmlspecialchars($offre['description']) ?></td>
                        <td><?= htmlspecialchars($offre['lieu']) ?></td>
                        <td><?= htmlspecialchars($offre['date']) ?></td>
                        <td><?= htmlspecialchars($offre['salaire']) ?></td>
                        <td><?= htmlspecialchars($offre['typeContrat']) ?></td>
                        <td><?= htmlspecialchars($offre['competencesRequises']) ?></td>
                        <td><?= htmlspecialchars($offre['experience']) ?></td>

                        <!-- Formulaire pour supprimer l'offre -->
                        <td>
                            <form method="post">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($offre['id']) ?>">
                                <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript pour Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



</body>
</html>