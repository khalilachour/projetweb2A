<?php
include '../config.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Générer un token aléatoire
    $token = bin2hex(random_bytes(50));

    // Insérer le token dans la base de données
    $stmt = $pdo->prepare("INSERT INTO password_resets (email, token) VALUES (?, ?)");
    $stmt->execute([$email, $token]);

    // Envoyer un e-mail à l'utilisateur avec le lien de réinitialisation
    $resetLink = "http://yourwebsite.com/reset_password.php?token=" . $token;
    mail($email, "Réinitialisation du mot de passe", "Cliquez sur ce lien pour réinitialiser votre mot de passe : " . $resetLink);
}
?>
<form method="POST">
    <input type="email" name="email" placeholder="Votre e-mail">
    <button type="submit">Réinitialiser le mot de passe</button>
</form>
