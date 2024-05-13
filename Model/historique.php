<?php
class HistoriqueModification {
    private $id;
    private $idOffre;
    private $anciennesDonnees;
    private $nouvellesDonnees;
    private $dateModification;

    public function __construct($idOffre, $anciennesDonnees, $nouvellesDonnees) {
        $this->idOffre = $idOffre;
        $this->anciennesDonnees = $anciennesDonnees;
        $this->nouvellesDonnees = $nouvellesDonnees;
        $this->dateModification = date("Y-m-d H:i:s"); // Date et heure actuelles
    }

    // Getters (accesseurs)
    public function getId() {
        return $this->id;
    }

    public function getIdOffre() {
        return $this->idOffre;
    }

    public function getAnciennesDonnees() {
        return $this->anciennesDonnees;
    }

    public function getNouvellesDonnees() {
        return $this->nouvellesDonnees;
    }

    public function getDateModification() {
        return $this->dateModification;
    }

    // Méthode pour enregistrer la modification dans la base de données
    public function enregistrer() {
        $sql = "INSERT INTO historique_modifications (id_offre, anciennes_donnees, nouvelles_donnees, date_modification) 
                VALUES (:id_offre, :anciennes_donnees, :nouvelles_donnees, :date_modification)";
    
        $db = config::getConnexion(); // Connexion à la base de données
    
        try {
            // Utiliser des variables intermédiaires pour `json_encode`
            $jsonAnciennesDonnees = json_encode($this->anciennesDonnees);
            $jsonNouvellesDonnees = json_encode($this->nouvellesDonnees);
    
            $query = $db->prepare($sql);
            $query->bindParam(':id_offre', $this->idOffre, PDO::PARAM_INT);
            $query->bindParam(':anciennes_donnees', $jsonAnciennesDonnees, PDO::PARAM_STR);
            $query->bindParam(':nouvelles_donnees', $jsonNouvellesDonnees, PDO::PARAM_STR);
            $query->bindParam(':date_modification', $this->dateModification);
    
            $query->execute(); // Exécuter la requête
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'enregistrement de la modification : " . $e->getMessage());
        }
    }
    
}
