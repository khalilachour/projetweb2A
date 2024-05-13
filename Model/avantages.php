<?php
class Avantage {
    private ?int $id; // L'identifiant unique pour chaque avantage
    private int $offre_id; // La clé étrangère reliant l'avantage à une offre
    private string $description; // La description de l'avantage
    private string $avantagesSociaux; // Les avantages sociaux
    private string $avantagesFinanciers; // Les avantages financiers
    private bool $developpementProfessionnel; // Indique s'il y a des opportunités de développement professionnel

    // Constructeur pour initialiser les propriétés de la classe
    public function __construct(
        int $offre_id, // Clé étrangère vers une offre
        string $description,
        string $avantagesSociaux,
        string $avantagesFinanciers,
        bool $developpementProfessionnel,
        ?int $id = null // L'identifiant peut être nul
    ) {
        $this->offre_id = $offre_id; // L'offre à laquelle cet avantage est lié
        $this->description = $description; // La description de l'avantage
        $this->avantagesSociaux = $avantagesSociaux; // Les avantages sociaux
        $this->avantagesFinanciers = $avantagesFinanciers; // Les avantages financiers
        $this->developpementProfessionnel = $developpementProfessionnel; // Développement professionnel
        $this->id = $id; // L'identifiant de l'avantage (si connu)
    }

    // Méthodes Getters
    public function getOffreId(): int {
        return $this->offre_id; // Retourne la clé étrangère liée à l'offre
    }

    public function getDescription(): string {
        return $this->description; // Retourne la description de l'avantage
    }

    public function getAvantagesSociaux(): string {
        return $this->avantagesSociaux; // Retourne les avantages sociaux
    }

    public function getAvantagesFinanciers(): string {
        return $this->avantagesFinanciers; // Retourne les avantages financiers
    }

    public function getDeveloppementProfessionnel(): bool {
        return $this->developpementProfessionnel; // Retourne l'opportunité de développement professionnel
    }
    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function setOffreId(int $offre_id): void {
        $this->offre_id = $offre_id;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setAvantagesSociaux(string $avantagesSociaux): void {
        $this->avantagesSociaux = $avantagesSociaux;
    }

    public function setAvantagesFinanciers(string $avantagesFinanciers): void {
        $this->avantagesFinanciers = $avantagesFinanciers;
    }

    public function setDeveloppementProfessionnel(bool $developpementProfessionnel): void {
        $this->developpementProfessionnel = $developpementProfessionnel;
    }

    // Autres méthodes getters et setters...
    public function toArray() {
        return [
            'offre_id' => $this->offre_id,
            'description' => $this->description,
            'avantagesSociaux' => $this->avantagesSociaux,
            'avantagesFinanciers' => $this->avantagesFinanciers,
            'developpementProfessionnel' => $this->developpementProfessionnel,
        ];
    }
}

?>
