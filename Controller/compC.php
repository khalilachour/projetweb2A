<?php
require_once 'C:\xampp\htdocs\projet\config.php';
require_once 'C:\xampp\htdocs\projet\Model\compM.php';

class CompetenceController {

    public function listCompetencesByCandidature($id_candidature){
        $sql = "SELECT * FROM competences WHERE id_cand = :id_candidature";
        $db = Config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_candidature', $id_candidature);
            $stmt->execute();
            $competences = $stmt->fetchAll();
            return $competences;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    

    public function listCompetences(){
        $sql = "SELECT * FROM competences";
        $db = Config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $competences = $stmt->fetchAll();
            return $competences;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    





    public function addCompetence($id_cand, $nom, $niveau, $description){
        $db = Config::getConnexion();
        try {
            $sql = "INSERT INTO competences (id_cand, nom, niveau, description) VALUES (:id_cand, :nom, :niveau, :description)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_cand', $id_cand);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':niveau', $niveau);
            $stmt->bindParam(':description', $description);
            $stmt->execute();
            echo "Compétence ajoutée avec succès!";
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }
    

    public function deleteCompetence($id){
        $db = Config::getConnexion();
        try {
            $sql = "DELETE FROM competences WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            echo "Compétence supprimée avec succès!";
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }


    public function updateCompetence($id, $id_cand, $nom, $niveau, $description){
        $db = Config::getConnexion();
        try {
            $sql = "UPDATE competences SET id_cand = :id_cand, nom = :nom, niveau = :niveau, description = :description WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_cand', $id_cand);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':niveau', $niveau);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            echo "Compétence mise à jour avec succès!";
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }
    



    public function getCompetenceById($id) {
        $db = Config::getConnexion();
        try {
            $sql = "SELECT * FROM competences WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }


    



    public function deleteCompetencesByCandidatureId($id) {
        $db = Config::getConnexion();
        try {
            // Supprimer les compétences associées à la candidature
            $sql = "DELETE FROM competences WHERE id_cand = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            echo "Compétences de la candidature supprimées avec succès!";
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }



    public function searchCompetencesByName($nom){
        $sql = "SELECT * FROM competences WHERE nom LIKE :nom";
        $db = Config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':nom', '%' . $nom . '%', PDO::PARAM_STR); // Utilisation de % pour rechercher les correspondances partielles du nom
            $stmt->execute();
            $competences = $stmt->fetchAll();
            return $competences;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    public function getCompetencesByCandidatureId($id_candidature) {
        // Connexion à la base de données
        $db = Config::getConnexion();

        try {
            // Requête SQL pour récupérer les compétences associées à la candidature
            $sql = "SELECT * FROM competences WHERE id_cand = :id_candidature";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_candidature', $id_candidature);
            $stmt->execute();

            // Récupérer les résultats de la requête
            $competences = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $competences;
        } catch (Exception $e) {
            // Gérer les erreurs éventuelles
            die('Erreur : ' . $e->getMessage());
        }
    }

}





















?>
