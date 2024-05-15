<?php
class Candidature {
    private ?int $id;
    private int $id_offre;
    private int $id_user; // Déclaration de la propriété $id_user
    private string $date;
    private string $cv;
    private string $lettre;

    public function __construct($offre, $user, $d, $cv, $lettre){
        $this->id = null; // L'ID sera défini automatiquement par la base de données
        $this->id_offre = $offre;
        $this->id_user = $user;
        $this->date = $d;
        $this->cv = $cv;
        $this->lettre = $lettre;
    }

    // Getters & Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getIdOffre(): int {
        return $this->id_offre;
    }

    public function setIdOffre(int $id_offre): void {
        $this->id_offre = $id_offre;
    }



    public function getIduser(): int {
        return $this->id_user;
    }

    public function setIduser(int $id_user): void {
        $this->id_user = $id_user;
    }

    public function getDate(): string {
        return $this->date;
    }

    public function setDate(string $date): void {
        $this->date = $date;
    }

    public function getCv(): string {
        return $this->cv;
    }

    public function setCv(string $cv): void {
        $this->cv = $cv;
    }

    public function getLettre(): string {
        return $this->lettre;
    }

    public function setLettre(string $lettre): void {
        $this->lettre = $lettre;
    }
}
?>
