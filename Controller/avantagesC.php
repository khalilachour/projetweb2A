<?php
require_once 'C:/xampp/htdocs/projet/config.php';
require_once 'C:/xampp/htdocs/projet/Model/avantages.php'; // Classe modèle
require_once 'C:/xampp/htdocs/projet/Controller/avantagesC.php';
require_once 'C:/xampp/htdocs/projet/Model/avantages.php';
class AvantagesC {
    // Fonction pour ajouter un avantage
    public function ajouterAvantage(Avantage $avantage) {
        if (empty($avantage->getOffreId()) || !is_int($avantage->getOffreId()) || $avantage->getOffreId() <= 0) {
            throw new Exception("L'identifiant de l'offre doit être un entier positif.");
        }
    
        // Définir une regex qui autorise des lettres, des chiffres, des espaces, des virgules, des points, des traits d'union, etc.
        $regex = '/^[\w\s.,-]+$/';
    
        $description = $avantage->getDescription();
        if (empty($description) || !preg_match($regex, $description)) {
            throw new Exception("La description doit contenir des lettres, des chiffres, des espaces, des virgules, des points, des traits d'union, etc.");
        }
    
        $avantagesSociaux = $avantage->getAvantagesSociaux();
        if (empty($avantagesSociaux) || !preg_match($regex, $avantagesSociaux)) {
            throw new Exception("Les avantages sociaux doivent contenir des lettres, des chiffres, des espaces, etc.");
        }
    
        $avantagesFinanciers = $avantage->getAvantagesFinanciers();
        if (empty($avantagesFinanciers) || !preg_match($regex, $avantagesFinanciers)) {
            throw new Exception("Les avantages financiers doivent contenir des lettres, des chiffres, des espaces, etc.");
        }
    
        if (!is_bool($avantage->getDeveloppementProfessionnel())) {
            throw new Exception("Le développement professionnel doit être un booléen.");
        }
    
        $sql = "INSERT INTO avantages (offre_id, description, avantagesSociaux, avantagesFinanciers, developpementProfessionnel) 
                VALUES (:offre_id, :description, :avantagesSociaux, :avantagesFinanciers, :developpementProfessionnel)";
    
        $db = config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':offre_id', $avantage->getOffreId(), PDO::PARAM_INT);
            $query->bindValue(':description', $description, PDO::PARAM_STR);
            $query->bindValue(':avantagesSociaux', $avantagesSociaux, PDO::PARAM_STR);
            $query->bindValue(':avantagesFinanciers', $avantagesFinanciers, PDO::PARAM_STR);
            $query->bindValue(':developpementProfessionnel', $avantage->getDeveloppementProfessionnel(), PDO::PARAM_BOOL);
            
            $query->execute();
    
            return $query->rowCount();
    
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout de l'avantage : " . $e->getMessage());
        }
    }
    
    
    public function afficherAvantages(int $offre_id) {
        $sql = "SELECT * FROM avantages WHERE offre_id = :offre_id"; // Requête pour obtenir les avantages associés à une offre
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':offre_id', $offre_id, PDO::PARAM_INT);
            $query->execute();
            $avantages = $query->fetchAll();
            return $avantages;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des avantages : " . $e->getMessage());
        }
    }
    public function getAvantageByOffreId(int $offre_id): ?Avantage
{
    $sql = "SELECT * FROM avantages WHERE offre_id = :offre_id";
    $db = config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->bindParam(':offre_id', $offre_id, PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Avantage(
                $result['id'],
                $result['offre_id'],
                $result['description'],
                $result['avantagesSociaux'],
                $result['avantagesFinanciers'],
                (bool) $result['developpementProfessionnel']
            );
        }

        return null; // Si aucun avantage n'est trouvé

    } catch (Exception $e) {
        throw new Exception("Erreur lors de la récupération des avantages : " . $e->getMessage());
    }
}
    // Modifier l'avantage par ID de l'offre
    public function modifierAvantageParOffre(int $offreId, array $donnees) {
        // Obtenir l'avantage existant
        $avantage = $this->getAvantageByOffreId($offreId);
    
        if (!$avantage) {
            throw new Exception("Aucun avantage associé à cette offre.");
        }
    
        // Mettre à jour les propriétés de l'avantage
        if (isset($donnees['description'])) {
            $avantage->setDescription($donnees['description']);
        }
    
        if (isset($donnees['avantagesSociaux'])) {
            $avantage->setAvantagesSociaux($donnees['avantagesSociaux']);
        }
    
        if (isset($donnees['avantagesFinanciers'])) {
            $avantage->setAvantagesFinanciers($donnees['avantagesFinanciers']);
        }
    
        if (isset($donnees['developpementProfessionnel'])) {
            $avantage->setDeveloppementProfessionnel($donnees['developpementProfessionnel']);
        }
    
        // Préparer la requête pour la mise à jour de l'avantage
        $sql = "UPDATE avantages 
                SET 
                    description = :description,
                    avantagesSociaux = :avantagesSociaux,
                    avantagesFinanciers = :avantagesFinanciers,
                    developpementProfessionnel = :developpementProfessionnel
                WHERE offre_id = :offre_id";
    
        $db = config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
    
            // Lier les paramètres avec les nouvelles valeurs
            $query->bindValue(':offre_id', $offreId, PDO::PARAM_INT);
            $query->bindValue(':description', $avantage->getDescription());
            $query->bindValue(':avantagesSociaux', $avantage->getAvantagesSociaux());
            $query->bindValue(':avantagesFinanciers', $avantage->getAvantagesFinanciers());
            $query->bindValue(':developpementProfessionnel', $avantage->getDeveloppementProfessionnel() ? 1 : 0);
    
            // Exécuter la requête
            $query->execute();
    
            return $query->rowCount(); // Retourner le nombre de lignes modifiées
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la modification de l'avantage : " . $e->getMessage());
        }
    }
    public function supprimerAvantagesParOffre(int $offre_id) {
        // Requête SQL pour supprimer les avantages associés à une offre
        $sql = "DELETE FROM avantages WHERE offre_id = :offre_id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindParam(':offre_id', $offre_id, PDO::PARAM_INT);
            $query->execute();

            return $query->rowCount(); // Retourner le nombre de lignes supprimées
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la suppression des avantages : " . $e->getMessage());
        }}
    
   
}
?>
