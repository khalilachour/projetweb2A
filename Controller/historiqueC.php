<?php
require_once 'C:/xampp/htdocs/projet/config.php';
require_once 'C:/xampp/htdocs/projet/Model/historique.php';
class historiqueModificationsC {
    // Obtenir l'historique des modifications
    public function obtenirHistorique() {
        $sql = "SELECT * FROM historique_modifications ORDER BY date_modification DESC";
        $db = config::getConnexion(); // Obtenir la connexion à la base de données

        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC); // Récupérer toutes les lignes
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération de l'historique : " . $e->getMessage());
        }
    }

    // Enregistrer une modification dans l'historique
    public function enregistrerHistoriqueModification($idOffre, $anciennes_donnees, $nouvelles_donnees) {
        $sql = "INSERT INTO historique_modifications (idOffre, anciennes_donnees, nouvelles_donnees, date_modification) 
                VALUES (:idOffre, :anciennes_donnees, :nouvelles_donnees, NOW())";
    
        $db = config::getConnexion(); // Connexion à la base de données
    
        try {
            $query = $db->prepare($sql);
    
            // Utiliser des variables pour stocker les valeurs encodées en JSON
            $jsonAnciennesDonnees = json_encode($anciennes_donnees);
            $jsonNouvellesDonnees = json_encode($nouvelles_donnees);
    
            // Passer les variables à bindParam
            $query->bindParam(':idOffre', $idOffre, PDO::PARAM_INT);
            $query->bindParam(':anciennes_donnees', $jsonAnciennesDonnees, PDO::PARAM_STR);
            $query->bindParam(':nouvelles_donnees', $jsonNouvellesDonnees, PDO::PARAM_STR);
    
            $query->execute(); // Exécuter la requête
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'enregistrement de l'historique de modification : " . $e->getMessage());
        }
    }
    public function obtenirHistoriqueDates() {
        $db = config::getConnexion();
        $sql = "SELECT date_modification, anciennes_donnees, nouvelles_donnees FROM historique_modifications";
        $query = $db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenirHistoriqueAvecPagination($limit, $offset) {
        $sql = "SELECT * FROM historique_modifications LIMIT :limit OFFSET :offset";
        $db = config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':limit', $limit, PDO::PARAM_INT);
            $query->bindParam(':offset', $offset, PDO::PARAM_INT);
            $query->execute();
    
            return $query->fetchAll();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération de l'historique: " . $e->getMessage());
        }
    }
    
    
}
