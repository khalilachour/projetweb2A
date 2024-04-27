<?php
class User {
    private $user_id;
    private $username;
    private $email;
    private $password;
    private $type;
    private $age;
    private $localisation;
    private $created_at;

    // Constructor
    public function __construct($username, $email, $password, $type, $age, $localisation) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->type = $type;
        $this->age = $age;
        $this->localisation = $localisation;
    }

    // Getters and setters

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getAge() {
        return $this->age;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function getLocalisation() {
        return $this->localisation;
    }

    public function setLocalisation($localisation) {
        $this->localisation = $localisation;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }
}
?>
