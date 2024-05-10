<?php
include 'C:/xampp/htdocs/nouveau/controller/compC.php';

$CC = new CompetenceController(); // Création de l'instance du contrôleur

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $id_candidature = $_GET['id_candidature'];


    

    $CC->deleteCompetence($id);
    
    header('location: afficher_comp.php?id_candidature=' . $id_candidature);
}
?>
