<?php
include 'C:/xampp/htdocs/projet/Controller/compC.php';

$CC = new CompetenceController();

// Vérifie si les données du formulaire ont été soumises
if(isset($_POST['id'], $_POST['id_candidature'], $_POST['nom'], $_POST['niveau'], $_POST['description'])) {
    // Récupère les valeurs du formulaire
    $id = $_POST['id'];
    $id_candidature = $_POST['id_candidature'];
    $nom = $_POST['nom'];
    $niveau = $_POST['niveau'];
    $description = $_POST['description'];
    
    // Appelle la méthode pour mettre à jour la compétence
    $CC->updateCompetence($id, $id_candidature, $nom, $niveau, $description);

    // Redirige vers la page d'affichage des compétences avec l'ID de la candidature
    header('location: afficher_comp.php?id_candidature=' . $id_candidature);
} else {
    // Si les données du formulaire ne sont pas soumises, redirige vers une autre page ou affiche un message d'erreur
    echo "Erreur: Les données du formulaire ne sont pas complètes.";
}
?>

