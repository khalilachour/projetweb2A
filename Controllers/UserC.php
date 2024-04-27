<?php

include __DIR__ . '/../config.php';
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

    public function updateUser($userId, $username, $email, $password, $type, $age, $localisation) {
        $sql = "UPDATE Users SET username=:username, email=:email, password=:password, type=:type, age=:age, localisation=:localisation WHERE user_id=:userId";
        $db = Config::getConnexion();
        try {
            $q = $db->prepare($sql);
            $q->bindValue(':username', $username);
            $q->bindValue(':email', $email);
            $q->bindValue(':password', $password);
            $q->bindValue(':type', $type);
            $q->bindValue(':age', $age);
            $q->bindValue(':localisation', $localisation);
            $q->bindValue(':userId', $userId);
            $q->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }

}
?>
