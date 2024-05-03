<?php 

    require_once 'model/model.php';
    
        function test(){
            $x = connexion();
            echo "cnx réussie à la BD";
        }


        function main(){
            require_once 'views/vue_principale.php';
        }

        /*function afficher(){
            require_once 'views/vue_afficher.php';
        }*/

        function afficher(){
            $elements = get_data();
            require_once 'views/vue_afficher.php';
        }

/*
        function fixer_date() {
            if (isset($_GET['id_offre'])) {
                // Récupérer l'ID de l'offre depuis la requête GET
                $idOffre = $_GET['id_offre'];
            
                // Appeler une fonction du contrôleur pour récupérer les informations sur l'offre
                $offreInfo = get_details_offre($idOffre);
            
                // Vérifier si les informations sur l'offre ont été récupérées avec succès
                if ($offreInfo) {
                    // Afficher le nom et le lieu de l'offre
                    echo "Nom de l'offre : " . $offreInfo->nom_poste . "<br>";
                    echo "Lieu de l'offre : " . $offreInfo->lieu . "<br>";
                }
            // Charger la vue entretien.php avec les détails de l'offre
            require_once 'entretiens.php';
           

        }
    }*/


    function fixer_date($idOffre) {
        // Appeler la fonction du modèle pour récupérer les détails de l'offre
        $offreInfo = get_details_offre($idOffre);
        
        // Vérifier si les informations sur l'offre ont été récupérées avec succès
        if ($offreInfo) {
            // Retourner les informations sur l'offre
            return $offreInfo;
        } else {
            // Gérer le cas où les informations sur l'offre ne peuvent pas être récupérées
            echo "Erreur lors de la récupération des détails de l'offre.";
            return null;
        }
    }
    
    




?>