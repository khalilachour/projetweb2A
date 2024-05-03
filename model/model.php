<?php

    function connexion(){
        return new PDO('mysql:dbname=projet_devweb;host=localhost', 'root', '');
    }

/*
    function send_data(){
        // Récupération des données du formulaire
        $id = $_POST['id'];
        $date = $_POST['date'];
        
        $nom_fichier_cv = $_FILES['cv']['name'];
        $temp_name_cv = $_FILES['cv']['tmp_name'];
        $taille_fichier_cv = $_FILES['cv']['size'];
    
        $nom_fichier_lettre = $_FILES['lettre']['name'];
        $temp_name_lettre = $_FILES['lettre']['tmp_name'];
        $taille_fichier_lettre = $_FILES['lettre']['size'];
    
        // Vérification et traitement du fichier CV
        if(isset($nom_fichier_cv) && !empty($nom_fichier_cv)) {
            $dossier = "uploads/";
            $nom_final_fichier_cv = $id . "_cv_" . $nom_fichier_cv;
            if(move_uploaded_file($temp_name_cv, $dossier . $nom_final_fichier_cv)) {
                echo "Le fichier CV a été téléchargé avec succès.";
            } else {
                echo "Erreur lors du téléchargement du fichier CV.";
            }
        } else {
            echo "Aucun fichier CV n'a été téléchargé.";
        }
    
        // Vérification et traitement du fichier Lettre
        if(isset($nom_fichier_lettre) && !empty($nom_fichier_lettre)) {
            $dossier = "uploads/";
            $nom_final_fichier_lettre = $id . "_lettre_" . $nom_fichier_lettre;
            if(move_uploaded_file($temp_name_lettre, $dossier . $nom_final_fichier_lettre)) {
                echo "Le fichier Lettre a été téléchargé avec succès.";
            } else {
                echo "Erreur lors du téléchargement du fichier Lettre.";
            }
        } else {
            echo "Aucun fichier Lettre n'a été téléchargé.";
        }
    
        // Connexion à la base de données et insertion des données dans la table 'candidatures'
        $pdo = connexion();
        $sqlstate = $pdo->prepare('INSERT INTO candidatures (id, date, cv, lettre) VALUES (?, ?, ?, ?)');
        $sqlstate->execute([$id, $date, $nom_final_fichier_cv, $nom_final_fichier_lettre]);
    }
    */

    function send_data(){
        // Récupération des données du formulaire
        $id = $_POST['id'];
        $id_offre = $_POST['id_offre'];
        $date = $_POST['date'];
        
        $nom_fichier_cv = $_FILES['cv']['name'];
        $temp_name_cv = $_FILES['cv']['tmp_name'];
        $taille_fichier_cv = $_FILES['cv']['size'];
    
        $nom_fichier_lettre = $_FILES['lettre']['name'];
        $temp_name_lettre = $_FILES['lettre']['tmp_name'];
        $taille_fichier_lettre = $_FILES['lettre']['size'];
    
        $nom_final_fichier_cv = "";
        $nom_final_fichier_lettre = "";
    
        // Fonction pour vérifier si le fichier est un PDF
        function is_pdf($file) {
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            return $extension === 'pdf';
        }
    
        // Vérification et traitement du fichier CV
        if(isset($nom_fichier_cv) && !empty($nom_fichier_cv)) {
            if(is_pdf($nom_fichier_cv)) {
                $dossier = "uploads/";
                $nom_final_fichier_cv = $id . "_cv_" . $nom_fichier_cv;
                if(move_uploaded_file($temp_name_cv, $dossier . $nom_final_fichier_cv)) {
                    echo "Le fichier CV a été téléchargé avec succès.";
                } else {
                    echo "Erreur lors du téléchargement du fichier CV.";
                }
            } else {
                echo "Veuillez télécharger un fichier CV au format PDF.";
            }
        } else {
            echo "Aucun fichier CV n'a été téléchargé.";
        }
    
        // Vérification et traitement du fichier Lettre
        if(isset($nom_fichier_lettre) && !empty($nom_fichier_lettre)) {
            $dossier = "uploads/";
            $nom_final_fichier_lettre = $id . "_lettre_" . $nom_fichier_lettre;
            if(move_uploaded_file($temp_name_lettre, $dossier . $nom_final_fichier_lettre)) {
                echo "Le fichier Lettre a été téléchargé avec succès.";
            } else {
                echo "Erreur lors du téléchargement du fichier Lettre.";
            }
        } else {
            echo "Aucun fichier Lettre n'a été téléchargé.";
        }
    
        // Connexion à la base de données et insertion des données dans la table 'candidatures'
        $pdo = connexion();
        $sqlstate = $pdo->prepare('INSERT INTO candidatures (id, id_offre, date, cv, lettre) VALUES (?, ?, ?, ?, ?)');
        $sqlstate->execute([$id, $id_offre, $date, $nom_final_fichier_cv, $nom_final_fichier_lettre]);

        
    }
    


    function get_data(){
        $pdo = connexion();
        return $pdo->query('SELECT * FROM candidatures')->fetchAll(PDO::FETCH_OBJ);
    }


    function get_data2(){
        $pdo = connexion();
        return $pdo->query('SELECT * FROM competences')->fetchAll(PDO::FETCH_OBJ);
    }

    /*function delete_data($id){
        $pdo = connexion();
        $sqlstate = $pdo->prepare('DELETE FROM candidatures WHERE id = ?');
        $sqlstate->execute([$id]);
    }*/


    function delete_data($id) {
        $pdo = connexion();
    
        
            // Commencer une transaction
            $pdo->beginTransaction();
    
            // Supprimer les compétences associées à la candidature
            $sqlDeleteCompetences = $pdo->prepare('DELETE FROM competences WHERE id_cand = ?');
            $sqlDeleteCompetences->execute([$id]);
    
            // Ensuite, supprimer la candidature
            $sqlDeleteCandidature = $pdo->prepare('DELETE FROM candidatures WHERE id = ?');
            $sqlDeleteCandidature->execute([$id]);
    
            // Valider la transaction si les suppressions se sont bien déroulées
            $pdo->commit();
            
            // Retourner true pour indiquer que la suppression a réussi
            return true;
        
    }
    





    function delete_data2($id){
        $pdo = connexion();
        $sqlstate = $pdo->prepare('DELETE FROM competences WHERE id = ?');
        $sqlstate->execute([$id]);
    }





    function edit_data($id){
        $pdo = connexion();
        $sqlstate = $pdo->prepare('SELECT * FROM candidatures WHERE id = ?');
        $sqlstate->execute([$id]);
        return $sqlstate->fetch(PDO::FETCH_OBJ);
    }


    function edit_data2($id){
        $pdo = connexion();
        $sqlstate = $pdo->prepare('SELECT * FROM competences WHERE id = ?');
        $sqlstate->execute([$id]);
        return $sqlstate->fetch(PDO::FETCH_OBJ);
    }


    function update_data ($id,$date, $cv, $lettre){
        $pdo = connexion();
        $sqlstate = $pdo->prepare('UPDATE candidatures SET date = ?, cv = ?, lettre = ? WHERE id =?');
        $sqlstate->execute([$date, $cv, $lettre,$id]);
      //l'id est inchangeable peut etre car c where id=
    }


    function update_data2 ($id,$nom, $niveau, $description){
        $pdo = connexion();
        $sqlstate = $pdo->prepare('UPDATE competences SET nom = ?, niveau = ?, description = ? WHERE id =?');
        $sqlstate->execute([$nom, $niveau, $description,$id]);
      //l'id est inchangeable peut etre car c where id=
    }



    function get_id(){
        $pdo = connexion();
         // Requête SQL pour récupérer le dernier ID
         $sql = "SELECT MAX(id) AS dernier_id FROM candidatures";
         $stmt = $pdo->prepare($sql);
         $stmt->execute();
 
         // Récupérer le dernier ID
         $row = $stmt->fetch(PDO::FETCH_OBJ);
         $dernierId = $row->dernier_id;
 
 
         // Retourner le dernier ID
         return $dernierId;
    }


    function generate_new_id(){
        $last_id = get_id();
        return $last_id + 1;
    }

    function get_id2(){
        $pdo = connexion();
         // Requête SQL pour récupérer le dernier ID
         $sql = "SELECT MAX(id) AS dernier_id FROM competences";
         $stmt = $pdo->prepare($sql);
         $stmt->execute();
 
         // Récupérer le dernier ID
         $row = $stmt->fetch(PDO::FETCH_OBJ);
         $dernierId = $row->dernier_id;
 
 
         // Retourner le dernier ID
         return $dernierId;
    }

/*
    function send_data2(){
        
        // Récupération des données du formulaire
        $id_skill = $_POST['id_skill'];
        $nom = $_POST['nom'];
        $niveau = $_POST['niveau'];
        $description = $_POST['description'];
    
        // Connexion à la base de données et insertion des données dans la table 'candidatures'
        $pdo = connexion();
        $sqlstate = $pdo->prepare('INSERT INTO competences (id, nom, niveau, description) VALUES (?, ?, ?, ?)');
        $sqlstate->execute([$id_skill, $nom, $niveau, $description]);

    }
*/


function send_data2(){
    // Récupération des données du formulaire
    $id_skill = $_POST['id_skill'];
    $nom = $_POST['nom'];
    $niveau = $_POST['niveau'];
    $description = $_POST['description'];

    // Vous devez également récupérer l'ID de la candidature associée
    $id_candidature = $_POST['id_candidature']; // Assurez-vous de remplacer 'id_candidature' par le nom réel de votre champ HTML

    // Connexion à la base de données et insertion des données dans la table 'competences'
    $pdo = connexion();
    $sqlstate = $pdo->prepare('INSERT INTO competences (id, id_cand, nom, niveau, description) VALUES (?, ?, ?, ?, ?)');
    $sqlstate->execute([$id_skill, $id_candidature, $nom, $niveau, $description]);
}

    
   



    function get_data_comp($candidature_id) {
        $pdo = connexion();
        $query = "SELECT nom, niveau, description
                  FROM competences
                  WHERE id_cand = :candidature_id";
    
        // Préparer la requête
        $statement = $pdo->prepare($query);
        
        // Lier le paramètre :candidature_id
        $statement->bindParam(':candidature_id', $candidature_id, PDO::PARAM_INT);
        
        // Exécuter la requête
        $statement->execute();
        
        // Retourner le résultat sous forme d'objets
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    


    function get_last_id_cand_requete(){
        $pdo = connexion();
        // Requête SQL pour récupérer le dernier ID
        $sql = "SELECT id_cand FROM competences ORDER BY id DESC LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Récupérer le dernier ID
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $dernierId = $row->id_cand;


        // Retourner le dernier ID
        return $dernierId;
    }




?>