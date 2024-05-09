<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer l'adresse e-mail de l'utilisateur
    $email = $_POST['email'];

    // Générer un token de réinitialisation (vous devriez enregistrer ce token et l'associer à l'utilisateur dans votre base de données)
    $token = bin2hex(random_bytes(50));

    // Créer un lien de réinitialisation
    $reset_link = "https://yourwebsite.com/reset_password.php?token=$token";

    // Préparer le message e-mail
    $subject = "Password Reset Request";
    $message = "Click on the following link to reset your password: $reset_link";

    // Envoyer l'e-mail
    if (mail($email, $subject, $message)) {
        echo "Password reset email sent.";
    } else {
        echo "Email sending failed.";
    }
}
?>
