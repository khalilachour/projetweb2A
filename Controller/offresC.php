<?php 


require_once 'C:/xampp/htdocs/projet/config.php';
require_once 'C:/xampp/htdocs/projet/Model/offres.php';


class offresC {
    
    public function afficherOffresPourSocieteConnectee()
    {
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Ensure the company session variable is set
        if (!isset($_SESSION["company"])) {
            throw new Exception("Company session variable is not set.");
        }

        // Get the company name from the session and ensure it's safe
        $companyName = $_SESSION["company"];

        // SQL query to retrieve all offers for a given company
        $sql = "SELECT * FROM offres WHERE nomSociete = :companyName";

        // Get the database connection
        $db = config::getConnexion();

        try {
            // Use a prepared statement to prevent SQL injection
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':companyName', $companyName, PDO::PARAM_STR);

            // Execute the query and fetch the results
            $stmt->execute();

            // Return the list of results
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            // Handle exceptions and display an error message
            die('Error while displaying job offers: ' . $e->getMessage());
        }
    }

    public function listOffres() {
        $sql = "SELECT * FROM offres";
        $db = config::getConnexion();
        try {
            $q = $db->prepare($sql);
            $q->execute();
            return $q->fetchAll();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function supprimerOffre(int $id) {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('DELETE FROM offres WHERE id = :id');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            echo $query->rowCount() . " enregistrements supprimés avec succès";
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression : " . $e->getMessage();
        }
    }
    public function selectOffre($id){
        $sql = "SELECT * FROM offre WHERE id=:id"; // Nom de la table des offres d'emploi
        $db = config::getConnexion(); // Supposons que vous avez une classe config qui gère la connexion à la base de données
        try {
            $q = $db->prepare($sql);
            $q->bindValue(':id',$id);
            $q->execute();
            $r = $q->fetch();
            return $r;
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }
    public function modifierOffre(int $id, array $donnees) {
        try {
            $db = config::getConnexion(); // Obtenir la connexion à la base de données
    
            // Préparer la requête UPDATE avec les valeurs du formulaire
            $query = $db->prepare(
                'UPDATE offres SET 
                    nomRecruteur = :nomRecruteur,
                    nomSociete = :nomSociete,
                    titrePoste = :titrePoste,
                    description = :description,
                    lieu = :lieu,
                    date = :date,
                    salaire = :salaire,
                    typeContrat = :typeContrat,
                    competencesRequises = :competencesRequises,
                    experience = :experience
                WHERE id = :id'
            );
    
            // Exécuter la requête avec les données provenant du formulaire
            $query->execute([
                'id' => $id, // Identifiant de l'offre à modifier
                'nomRecruteur' => $donnees['nomRecruteur'],
                'nomSociete' => $donnees['nomSociete'],
                'titrePoste' => $donnees['titrePoste'],
                'description' => $donnees['description'],
                'lieu' => $donnees['lieu'],
                'date' => $donnees['date'],
                'salaire' => $donnees['salaire'],
                'typeContrat' => $donnees['typeContrat'],
                'competencesRequises' => $donnees['competencesRequises'],
                'experience' => $donnees['experience'],
            ]);
    
            // Afficher le nombre d'enregistrements modifiés
            echo $query->rowCount() . " enregistrements modifiés avec succès";
    
        } catch (PDOException $e) {
            echo "Erreur lors de la modification : " . $e->getMessage(); // Gestion de l'erreur
        }
    }
    
      // Fonction pour supprimer une offre par son identifiant
          /*public function afficher()
    {
        // Requête SQL pour récupérer toutes les offres
        $sql = "SELECT * FROM offres WHERE nomSociete == $_SESSION["company"]";

        // Obtenir la connexion à la base de données
        $db = config::getConnexion();

        try {
            // Exécution de la requête et récupération des résultats
            $liste = $db->query($sql);
            
            // Retourner la liste des résultats
            return $liste;

        } catch (Exception $e) {
            // Gérer les exceptions et afficher un message d'erreur
            die('Erreur lors de l\'affichage des offres : ' . $e->getMessage());
        }
    }*/
    // Function to retrieve offers for a specific company
// Start the session if it's not already started


// Function to display job offers
public function afficher()
{
    // Ensure the company session variable is set
    if (!isset($_SESSION["company"])) {
        throw new Exception("Company session variable is not set.");
    }

    // Get the company name from the session and ensure it's safe
    $companyName = $_SESSION["company"];

    // SQL query to retrieve all offers for a given company
    $sql = "SELECT * FROM offres WHERE nomSociete = :companyName";

    // Get the database connection
    $db = config::getConnexion();

    try {
        // Use a prepared statement to prevent SQL injection
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':companyName', $companyName, PDO::PARAM_STR);

        // Execute the query and fetch the results
        $stmt->execute();

        // Return the list of results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        // Handle exceptions and display an error message
        die('Error while displaying job offers: ' . $e->getMessage());
    }
}

// Check if the user is logged in


        public function addOffre($offre){
            // Vérification des données saisies
            if(empty($offre->getNomRecruteur()) || empty($offre->getNomSociete()) || empty($offre->getTitrePoste()) || empty($offre->getDescription()) || empty($offre->getLieu()) || empty($offre->getDate()) || empty($offre->getSalaire()) || empty($offre->getTypeContrat()) || empty($offre->getCompetencesRequises()) || empty($offre->getExperience())){
                echo "Tous les champs doivent être remplis.";
                exit; // Arrêter l'exécution du script
            }
    
    
            // Validation de la date
            $date = $offre->getDate();
            if(!strtotime($date)){
                echo "Date invalide.";
                exit; // Arrêter l'exécution du script
            }
    
            // Vérification du type de contrat
            $typeContrat = $offre->getTypeContrat();
            if($typeContrat != "CDI" && $typeContrat != "CDD" && $typeContrat != "Stage"){
                echo "Type de contrat invalide.";
                exit; // Arrêter l'exécution du script
            }
    
            
// Validation du salaire
$salaire = $offre->getSalaire();
if(!is_numeric($salaire) || $salaire <= 0){
    echo "Salaire invalide.";
    exit; // Arrêter l'exécution du script
}

// Validation de la longueur des champs textuels (par exemple, 100 caractères maximum pour le titre du poste et 500 caractères maximum pour la description)
$titrePoste = $offre->getTitrePoste();
$description = $offre->getDescription();
if(strlen($titrePoste) > 100 || strlen($description) > 500){
    echo "Le titre du poste ne peut pas dépasser 100 caractères et la description ne peut pas dépasser 500 caractères.";
    exit; // Arrêter l'exécution du script
}

$competencesRequises = $offre->getCompetencesRequises(); // Obtient les compétences requises

// Si c'est une chaîne, validez directement
if (!is_string($competencesRequises)) {
    echo "Compétences requises doivent être une chaîne.";
    exit; // Arrêter l'exécution du script si ce n'est pas une chaîne
}

if (!preg_match('/^[a-zA-Z\s]+$/', $competencesRequises)) {
    echo "Les compétences requises ne doivent contenir que des lettres et des espaces.";
    exit; // Arrêter l'exécution du script si validation échoue
}


// Validation de l'expérience requise
$experience = $offre->getExperience();
if(!is_numeric($experience) || $experience < 0){
    echo "Expérience requise invalide.";
    exit; // Arrêter l'exécution du script
}

    
            // Si toutes les vérifications sont réussies, procéder à l'ajout de l'offre dans la base de données
            $sql = "INSERT INTO offres (nomRecruteur, nomSociete, titrePoste, description, lieu, date, salaire, typeContrat, competencesRequises, experience) 
            VALUES (:nomRecruteur, :nomSociete, :titrePoste, :description, :lieu, :date, :salaire, :typeContrat, :competencesRequises, :experience)";
    
            $db = config::getConnexion(); // Supposons que vous avez une classe config qui gère la connexion à la base de données
            try {
                $q = $db->prepare($sql);
    
                $q->bindValue(':nomRecruteur', $offre->getNomRecruteur());
                $q->bindValue(':nomSociete', $offre->getNomSociete());
                $q->bindValue(':titrePoste', $offre->getTitrePoste());
                $q->bindValue(':description', $offre->getDescription());
                $q->bindValue(':lieu', $offre->getLieu());
                $q->bindValue(':date', $offre->getDate());
                $q->bindValue(':salaire', $offre->getSalaire());
                $q->bindValue(':typeContrat', $offre->getTypeContrat());
                $q->bindValue(':competencesRequises', $offre->getCompetencesRequises()); // Si les compétences requises sont stockées dans un tableau
                $q->bindValue(':experience', $offre->getExperience());
    
                $q->execute();
                return $db->lastInsertId();
    
            } catch (Exception $e) {
                die('Erreur : '.$e->getMessage());
            }
        }
        public function deleteOffre($id){
            $sql = "DELETE FROM offre WHERE id=:id";
            $db = config::getConnexion(); 
            try {
                $q = $db->prepare($sql);
                $q->bindValue(':id', $id);
                $q->execute();
            } catch (Exception $e) {
                die('Erreur : '.$e->getMessage());
            }
        }
        public function updateOffre($id, $titrePoste, $nomRecruteur, $nomSociete, $description, $lieu, $date, $salaire, $typeContrat, $competencesRequises, $experience){
            $sql = "UPDATE offres SET titre_poste=:titrePoste, nom_recrut=:nomRecruteur, nom_soc=:nomSociete, description=:description, lieu=:lieu, date=:date, salaire=:salaire, type_contrat=:typeContrat, competences_requises=:competencesRequises, experience=:experience WHERE id=:id";
            $db = config::getConnexion(); // Supposons que vous ayez une classe config qui gère la connexion à la base de données
            try {
                $q = $db->prepare($sql);
        
                // valeurs passées à travers les paramètres
                $q->bindValue(':id', $id);
                $q->bindValue(':titrePoste', $titrePoste);
                $q->bindValue(':nomRecruteur', $nomRecruteur);
                $q->bindValue(':nomSociete', $nomSociete);
                $q->bindValue(':description', $description);
                $q->bindValue(':lieu', $lieu);
                $q->bindValue(':date', $date);
                $q->bindValue(':salaire', $salaire);
                $q->bindValue(':typeContrat', $typeContrat);
                $q->bindValue(':competencesRequises', $competencesRequises);
                $q->bindValue(':experience', $experience);
        
                $q->execute();
            } catch (Exception $e) {
                die('Erreur : '.$e->getMessage());
            }
        }
        public function recupererOffre($id)
    {
        // Requête SQL pour récupérer l'offre avec l'ID spécifié
        $sql = "SELECT * FROM offres WHERE id = :id";

        // Obtenir la connexion à la base de données
        $db = config::getConnexion();

        try {
            // Préparer la requête avec un paramètre pour l'ID
            $query = $db->prepare($sql);

            // Lier le paramètre ID
            $query->bindParam(':id', $id, PDO::PARAM_INT);

            // Exécuter la requête
            $query->execute();

            // Récupérer l'offre (résultat unique)
            $offre = $query->fetch(PDO::FETCH_ASSOC);

            // Retourner l'offre
            return $offre;

        } catch (Exception $e) {
            // Gérer les exceptions et afficher un message d'erreur
            die('Erreur lors de la récupération de l\'offre : ' . $e->getMessage());
        }
    }
    public function affichers($motCle = '') {
        $sql = "SELECT * FROM offres";
        if (!empty($motCle)) {
            $sql .= " WHERE titrePoste LIKE :motCle";
        }
        
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            if (!empty($motCle)) {
                $query->bindValue(':motCle', '%' . $motCle . '%');
            }
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'affichage des offres : " . $e->getMessage());
        }
    }
    public function getStatistiquesParSalaire() {
        $sql = "
            SELECT 
                CASE 
                    WHEN salaire <= 2000 THEN '0-2000'
                    WHEN salaire > 2000 AND salaire <= 4000 THEN '2001-4000'
                    WHEN salaire > 4000 AND salaire <= 6000 THEN '4001-6000'
                    ELSE '6001+' 
                END as salaire_range,
                COUNT(*) as nombre_offres
            FROM offres
            GROUP BY salaire_range
        ";
        
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des statistiques par salaire : " . $e->getMessage());
        }
    }
    public function getStatistiquesDeveloppementProfessionnel() {
        $sql = "
            SELECT 
                CASE 
                    WHEN developpementProfessionnel = 1 THEN 'Oui'
                    ELSE 'Non'
                END as developpement,
                COUNT(*) as nombre_offres
            FROM avantages
            GROUP BY developpement
        ";

        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des statistiques de développement professionnel : " . $e->getMessage());
        }
    }
    public function affichere($motCle = '', $trier = '') {
        $db = config::getConnexion(); // Connexion à la base de données

        // Déterminer l'ordre de tri par défaut
        $ordre = 'salaire DESC'; // Trier par salaire décroissant

        // Changer l'ordre de tri selon le choix de l'utilisateur
        if (!empty($trier)) {
            switch ($trier) {
                case 'date':
                    $ordre = 'date DESC'; // Trier par date de publication décroissante
                    break;
                case 'titre':
                    $ordre = 'titrePoste ASC'; // Trier par titre du poste
                    break;
                case 'salaire':
                    $ordre = 'salaire DESC'; // Trier par salaire décroissant
                    break;
            }
        }

        // Construire la requête SQL
        if (!empty($motCle)) {
            // Si un mot-clé est donné, filtrer les résultats par ce mot-clé
            $sql = "SELECT * FROM offres WHERE (titrePoste LIKE :motCle OR description LIKE :motCle OR nomSociete LIKE :motCle) ORDER BY $ordre";
            $query = $db->prepare($sql);
            $query->bindValue(':motCle', '%' . $motCle . '%', PDO::PARAM_STR);
        } else {
            // Sinon, récupérer toutes les offres triées
            $sql = "SELECT * FROM offres ORDER BY $ordre";
            $query = $db->prepare($sql);
        }

        try {
            // Exécuter la requête et récupérer les résultats
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC); // Retourner toutes les offres trouvées
        } catch (PDOException $e) {
            die("Erreur lors de l'affichage des offres : " . $e->getMessage());
        }
        
    }
    // Function to fetch offers based on keyword, sort order, and logged-in company

    public function enregistrerHistoriqueModification($id_offre, $anciennes_donnees, $nouvelles_donnees) {
        $sql = "INSERT INTO historique_modifications (id_offre, anciennes_donnees, nouvelles_donnees, date_modification) 
                VALUES (:id_offre, :anciennes_donnees, :nouvelles_donnees, NOW())";
    
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
    
            // Convertir les données en JSON
            $anciennes_donnees_json = json_encode($anciennes_donnees);
            $nouvelles_donnees_json = json_encode($nouvelles_donnees);
    
            $query->bindParam(':id_offre', $id_offre, PDO::PARAM_INT);
            $query->bindParam(':anciennes_donnees', $anciennes_donnees_json, PDO::PARAM_STR);
            $query->bindParam(':nouvelles_donnees', $nouvelles_donnees_json, PDO::PARAM_STR);
    
            $query->execute(); // Exécuter la requête
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'enregistrement de l'historique de modification : " . $e->getMessage());
        }
    }
    public function getOffreById($id) {
        // Requête SQL pour récupérer une offre par son identifiant
        $sql = "SELECT * FROM offres WHERE id = :id";

        // Connexion à la base de données
        $db = config::getConnexion(); // Assurez-vous que `config::getConnexion()` retourne une connexion valide
        
        try {
            $query = $db->prepare($sql); // Préparer la requête
            $query->bindParam(':id', $id, PDO::PARAM_INT); // Lier l'identifiant à la requête
            $query->execute(); // Exécuter la requête
            
            // Récupérer le résultat
            $result = $query->fetch(PDO::FETCH_ASSOC); // Récupérer les résultats sous forme associative
            
            return $result; // Retourner le résultat
            
        } catch (Exception $e) {
            // Gérer les exceptions si la requête échoue
            throw new Exception("Erreur lors de la récupération de l'offre par ID: " . $e->getMessage());
        }
    }
    public function afficherAvecPagination($limit, $offset) {
        $sql = "SELECT * FROM offres LIMIT :limit OFFSET :offset";
        $db = config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':limit', $limit, PDO::PARAM_INT);
            $query->bindParam(':offset', $offset, PDO::PARAM_INT);
            $query->execute();
    
            return $query->fetchAll();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des offres: " . $e->getMessage());
        }
    }
    
    
}
?>