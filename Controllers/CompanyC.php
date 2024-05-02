<?php

include_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../Models/Company.php';

class CompanyC {

    public function listCompanies() {
        $sql = "SELECT * FROM Societes";
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

    public function selectCompany($id) {
        $sql = "SELECT * FROM Societes WHERE societe_id=:id";
        $db = Config::getConnexion();
        try {
            $q = $db->prepare($sql);
            $q->bindValue(':id', $id);
            $q->execute();
            $r = $q->fetch();
            return $r;
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }

    public function getCompany($id) {
        try {
            $sql = "SELECT * FROM Societes WHERE societe_id = :id";
            $db = Config::getConnexion();
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function deleteCompany($id) {
        $sql = "DELETE FROM Societes WHERE societe_id=:id";
        $db = Config::getConnexion();
        try {
            $q = $db->prepare($sql);
            $q->bindValue(':id', $id);
            $q->execute();
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }

    public function addCompany($company) {
        $sql = "INSERT INTO Societes (nom_societe, email, password, type, numero, capital, localisation) 
                VALUES (:nom_societe, :email, :password, :type, :numero, :capital, :localisation)";

        $db = Config::getConnexion();
        try {
            $q = $db->prepare($sql);
            $q->bindValue(':nom_societe', $company->getNomSociete());
            $q->bindValue(':email', $company->getEmail());
            $q->bindValue(':password', $company->getPassword());
            $q->bindValue(':type', $company->getType());
            $q->bindValue(':numero', $company->getNumero());
            $q->bindValue(':capital', $company->getCapital());
            $q->bindValue(':localisation', $company->getLocalisation());
            $q->execute();
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }

    public function updateCompanyByEmail($email, $nom_societe, $numero, $capital, $localisation) {
        $sql = "UPDATE Societes SET nom_societe=:nom_societe, numero=:numero, 
                capital=:capital, localisation=:localisation WHERE email=:email";
        $db = Config::getConnexion();
        try {
            $q = $db->prepare($sql);
            $q->bindValue(':nom_societe', $nom_societe);
            $q->bindValue(':numero', $numero);
            $q->bindValue(':capital', $capital);
            $q->bindValue(':localisation', $localisation);
            $q->bindValue(':email', $email);
            $q->execute();
            return true; // Succès de la
        }catch (Exception $e){
            die('Erreur :'.$e->getMessage());
        }
    }
    
    public function isEmailExists($email) {
        $sql = "SELECT COUNT(*) as count FROM Societes WHERE email = :email";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result['count'] > 0) {
                // If email exists, return true and display a styled message
                echo '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; border-radius: 5px;">';
                echo 'This email is already taken.';
                echo '</div>';
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Handle database connection errors
            echo '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; border-radius: 5px;">';
            echo 'Error: ' . $e->getMessage();
            echo '</div>';
            return false;
        }
    }
    public function getCompanyTypes() {
        $sql = "SELECT DISTINCT type FROM Societes";
        $db = Config::getConnexion();
        try {
            $q = $db->query($sql);
            $types = $q->fetchAll(PDO::FETCH_COLUMN);
            return $types;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    // Method to count the number of companies for each type
    public function getCompanyCountByType($type) {
        $sql = "SELECT COUNT(*) AS count FROM Societes WHERE type = :type";
        $db = Config::getConnexion();
        try {
            $q = $db->prepare($sql);
            $q->bindValue(':type', $type);
            $q->execute();
            $result = $q->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
?>
