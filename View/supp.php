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
