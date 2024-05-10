<?php
require_once 'C:\xampp\htdocs\nouveau\config.php';
require_once 'C:\xampp\htdocs\nouveau\model\candM.php';
include_once 'C:/xampp/htdocs/nouveau/controller/compC.php';

class CandidatureController {

    public function listCandidatures(){
        $sql = "SELECT * FROM candidatures";
        $db = Config::getConnexion();
        try {
            $q = $db->prepare($sql);
            $q->execute();
            $r = $q->fetchAll();
            return $r;
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }


    public function addCandidature($id_offre, $date, $cv, $lettre){
        $db = Config::getConnexion();
        try {
            $sql = "INSERT INTO candidatures (id_offre, date, cv, lettre) VALUES (:id_offre, :date, :cv, :lettre)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_offre', $id_offre);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':cv', $cv);
            $stmt->bindParam(':lettre', $lettre);
            $stmt->execute();
            echo "Candidature ajoutée avec succès!";
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }







   /* public function deleteCandidature($id){
        $db = Config::getConnexion();
        try {
            $sql = "DELETE FROM candidatures WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            echo "Candidature supprimée avec succès!";
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }*/



    public function deleteCandidature($id) {
        $CC = new CompetenceController(); // Créer une instance du Contrôleur des Compétences

        // Supprimer d'abord les compétences associées à la candidature
        $CC->deleteCompetencesByCandidatureId($id);

        // Ensuite, supprimer la candidature
        $db = Config::getConnexion();
        try {
            $sql = "DELETE FROM candidatures WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            echo "Candidature supprimée avec succès!";
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }













    public function updateCandidature($id, $id_offre, $date, $cv, $lettre){
        $db = Config::getConnexion();
        try {
            $sql = "UPDATE candidatures SET id_offre = :id_offre, date = :date, cv = :cv, lettre = :lettre WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_offre', $id_offre);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':cv', $cv);
            $stmt->bindParam(':lettre', $lettre);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            echo "Candidature mise à jour avec succès!";
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }



    public function getCandidatureById($id) {
        $db = Config::getConnexion();
        try {
            $sql = "SELECT * FROM candidatures WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }



    public function getLastInsertedId() {
        $db = Config::getConnexion();
        try {
            // Utilisation de la fonction lastInsertId() pour récupérer l'ID de la dernière insertion
            $lastId = $db->lastInsertId();
            return $lastId;
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }
 
    
    


    public function getOffreDetailsByCandidatureId($id_candidature) {
        $db = Config::getConnexion();
        try {
            $sql = "SELECT offres.id, offres.nom_poste, offres.lieu FROM offres 
                    INNER JOIN candidatures ON offres.id = candidatures.id_offre 
                    WHERE candidatures.id = :id_candidature";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_candidature', $id_candidature, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    



    public function listCandidaturesByDate($date_filtre) {
        $db = Config::getConnexion();
        try {
            // Préparez votre requête SQL pour sélectionner les candidatures filtrées par date
            $sql = "SELECT * FROM candidatures WHERE date = :date_filtre";
            $stmt = $db->prepare($sql);
            // Liez le paramètre de date
            $stmt->bindParam(':date_filtre', $date_filtre);
            // Exécutez la requête
            $stmt->execute();
            // Récupérez les résultats sous forme de tableau associatif
            $candidatures = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $candidatures;
        } catch (Exception $e) {
            // En cas d'erreur, affichez un message d'erreur
            die('Erreur : ' . $e->getMessage());
        }
    }


}



?>
