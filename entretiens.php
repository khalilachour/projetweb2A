<?php
    require_once 'controller/controller.php';
    /*$date = $_GET['date'];
    echo $date;
fixer_date();*/





//entretiens.php
// Vérifier si les paramètres 'date' et 'id_offre' sont présents dans l'URL
if (isset($_GET['date']) && isset($_GET['id_offre'])) {
    // Récupérer la date et l'ID de l'offre depuis l'URL
    $date = $_GET['date'];
    $idOffre = $_GET['id_offre'];

    // Appeler la fonction fixer_date() pour afficher les détails de l'offre
    $offreDetails = fixer_date($idOffre);

    // Charger la vue_entretiens.php avec les données récupérées
    require_once 'views/vue_entretiens.php';
} 




?>





