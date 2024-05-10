<?php
include 'C:/xampp/htdocs/nouveau/controller/candC.php';

$CC = new CandidatureController(); // Création de l'instance du contrôleur

if(isset($_POST['id'], $_POST['id_offre'], $_POST['date'], $_FILES['new_cv'], $_FILES['new_lettre'])){
    $id = $_POST['id'];
    $id_offre = $_POST['id_offre'];
    $date = $_POST['date'];
    
    // Vérification et traitement du fichier CV
    if($_FILES['new_cv']['name'] != '') {
        $new_cv = $_FILES['new_cv']['name'];
        // Chemin où le nouveau fichier CV sera sauvegardé
        $cv_path = "C:/xampp/htdocs/nouveau/uploads/" . basename($new_cv);
        // Déplacement du fichier téléchargé vers le dossier uploads
        move_uploaded_file($_FILES['new_cv']['tmp_name'], $cv_path);
    } else {
        // Aucun nouveau fichier CV n'a été téléchargé, donc on garde le chemin du fichier existant
        $new_cv = $_POST['cv'];
    }

    // Vérification et traitement du fichier Lettre de motivation
    if($_FILES['new_lettre']['name'] != '') {
        $new_lettre = $_FILES['new_lettre']['name'];
        // Chemin où le nouveau fichier Lettre de motivation sera sauvegardé
        $lettre_path = "../nouveau/uploads/" . basename($new_lettre);
        // Déplacement du fichier téléchargé vers le dossier uploads
        move_uploaded_file($_FILES['new_lettre']['tmp_name'], $lettre_path);
    } else {
        // Aucun nouveau fichier Lettre de motivation n'a été téléchargé, donc on garde le chemin du fichier existant
        $new_lettre = $_POST['lettre'];
    }

    // Mise à jour de la candidature avec les nouveaux chemins des fichiers
    $CC->updateCandidature($id, $id_offre, $date, $new_cv, $new_lettre);
    header('location: afficher_cand.php');
   
}
?>