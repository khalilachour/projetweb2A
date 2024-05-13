<?php
include 'C:/xampp/htdocs/projet/Controller/candC.php';

$CC = new CandidatureController(); // Création de l'instance du contrôleur

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $CC->deleteCandidature($id);
    $id_offre = $_GET['offre_id'];
    header('Location: afficher_cand2.php?offre_id=' . $id_offre);

}
?>