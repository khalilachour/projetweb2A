<?php

include_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../Models/User.php';

class UserController {

    public function listUsers() {
        $sql = "SELECT * FROM Users";
        $db = Config::getConnexion();
        try {
            $q = $db->prepare($sql);
            $q->execute();
            $r = $q->fetchAll();
            return $r;
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }

    public function selectUser($id) {
        $sql = "SELECT * FROM Users WHERE user_id=:id";
        $db = Config::getConnexion();
        try {
            $q = $db->prepare($sql);
            $q->bindValue(':id', $id);
            $q->execute();
            $r = $q->fetch();
            return $r;
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }

    public function getUser($id) {
        try {
            $sql = "SELECT * FROM Users WHERE user_id = :id";
            $db = Config::getConnexion();
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM Users WHERE email = :email";
        $db = Config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                // If email exists, return the data
                return $result;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    

    public function deleteUser($id) {
        $sql = "DELETE FROM Users WHERE user_id=:id";
        $db = Config::getConnexion();
        try {
            $q = $db->prepare($sql);
            $q->bindValue(':id', $id);
            $q->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
        return true;
    }

    public function createUser($username, $email, $password, $type, $age, $localisation) {
        $sql = "INSERT INTO Users (username, email, password, type, age, localisation) 
                VALUES (:username, :email, :password, :type, :age, :localisation)";

        $db = Config::getConnexion();
        try {
            $q = $db->prepare($sql);
            $q->bindValue(':username', $username);
            $q->bindValue(':email', $email);
            $q->bindValue(':password', $password);
            $q->bindValue(':type', $type);
            $q->bindValue(':age', $age);
            $q->bindValue(':localisation', $localisation);
            $q->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }

    public function updateUserByEmail($email, $username, $type, $age, $localisation) {
        // Validate if the user is non-admin
        if ($type !== 'admin') {
            // Prepare and execute the update query
            $sql = "UPDATE users SET username=?, type=?, age=?, localisation=? WHERE email=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssss", $username, $type, $age, $localisation, $email);
            $stmt->execute();

            // Check if the update was successful
            if ($stmt->affected_rows > 0) {
                return true; // Return true if update was successful
            }
        }
        return false; // Return false if the user is an admin or update failed
    }

    // Other methods...


    // Other methods...

    public function isEmailExists($email) {
        $sql = "SELECT COUNT(*) as count FROM Users WHERE email = :email";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result['count'] > 0) {
                // If email exists, return true
                echo '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; border-radius: 5px;">';
                echo 'This email is already taken.';
                echo '</div>';
                return true;
               
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Handle database connection errors
            // You can throw an exception here to propagate the error to the caller
            // Alternatively, log the error and return false
            return false;
        }
    }
    

}
?>
