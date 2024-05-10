<?php

class Competence {
    private ?int $id;
    private int $id_cand;
    private string $nom;
    private string $niveau;
    private string $description;

    public function __construct($cand, $nom, $niv, $desc) {
        $this->id = null; // L'ID sera défini automatiquement par la base de données
        $this->id_cand = $cand;
        $this->nom = $nom;
        $this->niveau = $niv;
        $this->description = $desc;
    }

    // Getters & Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getIdCand(): int {
        return $this->id_cand;
    }

    public function setIdCand(int $id_cand): void {
        $this->id_cand = $id_cand;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function getNiveau(): string {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): void {
        $this->niveau = $niveau;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }
}

?>
