<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixer un rendez-vous</title>
    <style>
        /* Style CSS pour le formulaire */
        /* Vous pouvez personnaliser ce style selon vos besoins */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        form {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form action="traitement_rendezvous.php" method="post">
        <h2>Fixer un rendez-vous</h2>
        <?php
        // Inclure le fichier de configuration de la base de données et le contrôleur des candidatures
        require_once 'C:/xampp/htdocs/projet/config.php';
        require_once 'C:/xampp/htdocs/projet/Controller/candC.php';

        // Vérifier si l'ID de la candidature est présent dans l'URL
        if(isset($_GET['id_candidature'])) {
            // Récupérer l'ID de la candidature depuis l'URL
            $id_candidature = $_GET['id_candidature'];

            // Créer une instance du contrôleur des candidatures
            $candController = new CandidatureController();

            // Appeler la fonction pour récupérer les détails de l'offre associée à la candidature
            $offreDetails = $candController->getOffreDetailsByCandidatureId($id_candidature);

            // Vérifier si des résultats ont été trouvés
            if($offreDetails) {
                echo '<input type="hidden" name="id_candidature" value="' . $id_candidature . '">';

                // Afficher les données de l'offre (vous pouvez les utiliser dans le formulaire)
                echo '<input type="hidden" name="id_offre" value="' . $offreDetails['id'] . '">';
                //echo '<label for="nom_offre">Nom de l\'offre :</label>';
                echo '<input type="hidden" id="nom_offre" name="nom_offre" value="' . $offreDetails['titrePoste'] . '" readonly>';
                //echo '<label for="lieu_offre">Lieu de l\'offre :</label>';
                echo '<input type="hidden" id="lieu_offre" name="lieu_offre" value="' . $offreDetails['lieu'] . '" readonly>';
                

            } else {
                echo 'Aucune offre trouvée pour cette candidature.';
            }
        } else {
            echo 'ID de candidature non spécifié dans l\'URL.';
        }
        ?>
        <label for="date_rendezvous">Date du rendez-vous :</label>
        <input type="date" id="date_rendezvous" name="date_rendezvous" required>
        <input type="submit" value="Confirmer le rendez-vous">
    </form>
</body>
</html>