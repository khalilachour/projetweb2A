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
    <style>
        table {
            font-size: 0.1em; /* Réduire la taille de la police */
        }

        th, td {
            padding: 0rem; /* Réduire la taille de la marge interne */
        }
    </style>
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
        <div class="table-responsive">
            <table class="table table-striped table-sm">
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
        </div>

        <h2>Historique des modifications</h2>
        <!-- Table pour l'historique des modifications -->
        <div class="table-responsive">
            <table class="table table-striped table-sm">
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
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Autres scripts nécessaires pour votre page -->
</body>
</html>

