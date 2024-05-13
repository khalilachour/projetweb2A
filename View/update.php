<?php
require_once '../config.php';
require_once '../Controller/offresC.php';
require_once '../Controller/avantagesC.php';
require_once '../Controller/historiqueC.php';

// Instancier les contrôleurs
$offresC = new offresC();
$avantagesC = new avantagesC();
$historiqueC = new historiqueModificationsC();
// Définir le nombre d'éléments par page
$elementsParPage = 10;  // Vous pouvez ajuster cette valeur

// Obtenir le numéro de page actuel pour les offres et l'historique
$pageActuelleOffres = isset($_GET['page_offres']) ? (int)$_GET['page_offres'] : 1;
$pageActuelleHistorique = isset($_GET['page_historique']) ? (int)$_GET['page_historique'] : 1;

// Calculer le décalage (offset)
$offsetOffres = ($pageActuelleOffres - 1) * $elementsParPage;
$offsetHistorique = ($pageActuelleHistorique - 1) * $elementsParPage;

// Obtenir le nombre total d'offres et d'entrées d'historique
//$totalOffres = $offresC->compterOffres();  // Créez cette méthode dans offresC
//$totalHistorique = $historiqueC->compterHistorique();  // Créez cette méthode dans historiqueC

// Calculer le nombre total de pages
$totalPagesOffres = ceil($totalOffres / $elementsParPage);
$totalPagesHistorique = ceil($totalHistorique / $elementsParPage);

// Récupérer les offres et l'historique avec pagination
$offres = $offresC->afficherAvecPagination($elementsParPage, $offsetOffres);
$historique = $historiqueC->obtenirHistoriqueAvecPagination($elementsParPage, $offsetHistorique);


// Récupérer toutes les offres
$offres = $offresC->afficher();

// Récupérer l'historique des modifications
$historique = $historiqueC->obtenirHistorique();

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id']; // Identifiant de l'offre à modifier

    // Récupérer les données du formulaire pour l'offre
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

    // Modifier l'offre
    $offresC->modifierOffre($id, $donneesOffre);

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

        // Modifier les avantages associés à l'offre
        if ($ancienAvantage) {
            $avantagesC->modifierAvantageParOffre($id, $donneesAvantage);
        } else {
            // Si aucun avantage n'existe pour cette offre, créez-le
            $avantagesC->ajouterAvantage( $avantage);
        }
    }

    // Enregistrer l'historique des modifications
    $historiqueC->enregistrerHistoriqueModification(
        $id,
        json_encode($ancienAvantage ? $ancienAvantage->toArray() : []),
        json_encode($donneesAvantage)
    );

    // Afficher un message de succès
    echo "Modifications enregistrées avec succès.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Liste des Offres d'Emploi</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
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
                        <!-- Formulaire pour modifier chaque ligne -->
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
                                    <h4>Avantages:</h4>
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

        <!-- Table pour afficher l'historique des modifications -->
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

    <!-- Fichiers JavaScript nécessaires -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
