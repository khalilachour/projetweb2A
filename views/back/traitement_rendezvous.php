<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les données nécessaires sont présentes
    if (isset($_POST['id_candidature']) && isset($_POST['id_offre']) && isset($_POST['nom_offre']) && isset($_POST['lieu_offre']) && isset($_POST['date_rendezvous'])) {
        // Récupérer les données du formulaire
        $id_candidature = $_POST['id_candidature'];
        $id_offre = $_POST['id_offre'];
        $nom_offre = $_POST['nom_offre'];
        $lieu_offre = $_POST['lieu_offre'];
        $date_rendezvous = $_POST['date_rendezvous'];

        // Définir le chemin du fichier de stockage
        $file_path = 'rendezvous_data.txt';

        // Créer une chaîne avec les données à stocker
        $data = "$id_candidature, $id_offre, $nom_offre, $lieu_offre, $date_rendezvous\n";

        // Ajouter les données au fichier
        if (file_put_contents($file_path, $data, FILE_APPEND | LOCK_EX) !== false) {
            echo "Rendez-vous enregistré avec succès!";
        } else {
            echo "Une erreur s'est produite lors de l'enregistrement du rendez-vous.";
        }
    } else {
        echo "Des données sont manquantes dans le formulaire.";
    }
} else {
    echo "Le formulaire n'a pas été soumis.";
}
?>
