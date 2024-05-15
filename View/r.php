<?php
include 'config.php';

if (isset($_POST['password']) && isset($_GET['token'])) {
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $token = $_GET['token'];

    // Obtenir l'e-mail associé au token
    $stmt = $pdo->prepare("SELECT email FROM password_resets WHERE token = ?");
    $stmt->execute([$token]);
    $email = $stmt->fetchColumn();

    // Mettre à jour le mot de passe de l'utilisateur
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->execute([$newPassword, $email]);

    // Mettre à jour le mot de passe de la société
    $stmt = $pdo->prepare("UPDATE Societes SET password = ? WHERE email = ?");
    $stmt->execute([$newPassword, $email]);

    // Supprimer le token
    $stmt = $pdo->prepare("DELETE FROM password_resets WHERE token = ?");
    $stmt->execute([$token]);

    echo "Votre mot de passe a été réinitialisé avec succès.";
}
?>
<form method="POST">
    <input type="password" name="password" placeholder="Nouveau mot de passe">
    <button type="submit">Changer le mot de passe</button>
</form>
