<?php
// Vérifie si la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si les champs du formulaire sont définis dans la requête POST
    if (isset($_POST['email'], $_POST['nom_societe'], $_POST['numero'], $_POST['capital'], $_POST['localisation'])) {
        // Récupère les données du formulaire de la requête POST
        $email = $_POST['email'];
        $nom_societe = $_POST['nom_societe'];
        $numero = $_POST['numero'];
        $capital = $_POST['capital'];
        $localisation = $_POST['localisation'];

        // Inclut les fichiers nécessaires et initialise la connexion à la base de données
        include_once __DIR__ . '/../Controllers/CompanyC.php';
        $companyC = new CompanyC();

        // Appelle la méthode pour mettre à jour les détails de l'entreprise
        $updateResult = $companyC->updateCompanyByEmail($email, $nom_societe, $numero, $capital, $localisation);

        // Vérifie le résultat de l'opération de mise à jour
        if ($updateResult) {
            // Redirige vers la page affichant la liste des entreprises ou effectue une autre action
            header("Location: contact.php");
            exit(); // Assurez-vous que le script se termine après la redirection
        } else {
            echo "Failed to update company. Please try again.";
        }
    } else {
        // Gère le cas où les champs du formulaire ne sont pas définis dans la requête POST
        echo "Missing form fields.";
    }
} else {
    // Gère le cas où la méthode de requête n'est pas POST
    echo "Invalid request method.";
}
?>
