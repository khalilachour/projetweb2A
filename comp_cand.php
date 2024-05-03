<?php 

    require_once 'controller/controller.php';
    
    // Récupération de l'ID de la candidature depuis l'URL
$candidature_id = $_GET['id'];

    afficher_comp($candidature_id);
    
?>