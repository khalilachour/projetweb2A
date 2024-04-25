<?php

class Company {
    private $societe_id;
    private $nom_societe;
    private $email;
    private $password;
    private $type;
    private $numero;
    private $capital;
    private $localisation;
    private $created_at;

    // Constructor
    public function __construct($nom_societe, $email, $password, $type, $numero, $capital, $localisation) {
        $this->nom_societe = $nom_societe;
        $this->email = $email;
        $this->password = $password;
        $this->type = $type;
        $this->numero = $numero;
        $this->capital = $capital;
        $this->localisation = $localisation;
    }

    // Getters and setters

    public function getSocieteId() {
        return $this->societe_id;
    }

    public function setSocieteId($societe_id) {
        $this->societe_id = $societe_id;
    }

    public function getNomSociete() {
        return $this->nom_societe;
    }

    public function setNomSociete($nom_societe) {
        $this->nom_societe = $nom_societe;
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

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getCapital() {
        return $this->capital;
    }

    public function setCapital($capital) {
        $this->capital = $capital;
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
