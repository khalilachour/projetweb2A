<?php
include 'C:/xampp/htdocs/projet/Controller/candC.php';

$CC = new CandidatureController(); // Création de l'instance du contrôleur

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $CC->deleteCandidature($id);
    
    header('Location: layout-static.php');

}
?>