<?php

    function connexion(){
        return new PDO('mysql:dbname=projet_devweb;host=localhost', 'root', '');
    }

    function get_data(){
        $pdo = connexion();
        return $pdo->query('SELECT * FROM candidatures')->fetchAll(PDO::FETCH_OBJ);
    }


    // model.php

function get_details_offre($idOffre) {
    $pdo = connexion();
    $stmt = $pdo->prepare('SELECT nom_poste, lieu FROM offres WHERE id = ?');
    $stmt->execute([$idOffre]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}



?>