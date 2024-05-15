<?php

class OffreEmploi {
    private ?int $id;
    private string $nomRecruteur;
    private string $nomSociete;
    private string $titrePoste;
    private string $description;
    private string $lieu;
    private string $date;
    private float $salaire;
    private string $typeContrat;
    private string $competencesRequises;
    private string $experience;

    // Constructeur
    public function __construct($id, $nomRecruteur, $nomSociete, $titrePoste, $description, $lieu, $date, $salaire, $typeContrat, $competencesRequises, $experience) {
        $this->id = $id;
        $this->nomRecruteur = $nomRecruteur;
        $this->nomSociete = $nomSociete;
        $this->titrePoste = $titrePoste;
        $this->description = $description;
        $this->lieu = $lieu;
        $this->date = $date;
        $this->salaire = $salaire;
        $this->typeContrat = $typeContrat;
        $this->competencesRequises = $competencesRequises;
        $this->experience = $experience;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNomRecruteur() {
        return $this->nomRecruteur;
    }

    public function getNomSociete() {
        return $this->nomSociete;
    }

    public function getTitrePoste() {
        return $this->titrePoste;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getLieu() {
        return $this->lieu;
    }

    public function getDate() {
        return $this->date;
    }

    public function getSalaire() {
        return $this->salaire;
    }

    public function getTypeContrat() {
        return $this->typeContrat;
    }

    public function getCompetencesRequises() {
        return $this->competencesRequises;
    }

    public function getExperience() {
        return $this->experience;
    }
    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNomRecruteur($nomRecruteur) {
        $this->nomRecruteur = $nomRecruteur;
    }

    public function setNomSociete($nomSociete) {
        $this->nomSociete = $nomSociete;
    }

    public function setTitrePoste($titrePoste) {
        $this->titrePoste = $titrePoste;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setLieu($lieu) {
        $this->lieu = $lieu;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setSalaire($salaire) {
        $this->salaire = $salaire;
    }

    public function setTypeContrat($typeContrat) {
        $this->typeContrat = $typeContrat;
    }

    public function setCompetencesRequises($competencesRequises) {
        $this->competencesRequises = $competencesRequises;
    }

    public function setExperience($experience) {
        $this->experience = $experience;
    }

}
