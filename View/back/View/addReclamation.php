<?php

include "../Controller/ReclamationC.php";

$error = "";

//create reclamation
$Reclamation = null;

// create an instance of the controller
$ReclamationC = new ReclamationC();
if (
    isset($_POST["nom"]) && isset($_POST["mail"]) && isset($_POST["reclam"])
) {
    if (
        !empty($_POST['nom']) && !empty($_POST['mail']) && !empty($_POST['reclam'])
    ) {
        $Reclamation = new Reclamation(
            null,
            $_POST['nom'],
            $_POST['mail'],
            $_POST['reclam']
        );
        $ReclamationC->addReclamation($Reclamation);
        header('Location: ListReclamations.php');
        exit();
    } else {
        $error = "Missing information";
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
</head>

<body>
    <a href="ListReclamations.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST" onsubmit="return validateForm()">
        <table border="1" align="center">

            <tr>
                <td>
                    <label for="nom">nom:
                    </label>
                </td>
                <td><input type="text" name="nom" id="nom" maxlength="20"></td>
            </tr>

            <tr>
                <td>
                    <label for="mail">mail:
                    </label>
                </td>
                <td><input type="text" name="mail" id="mail" maxlength="255"></td>
            </tr>

            <tr>
                <td>
                    <label for="reclam">reclam:
                    </label>
                </td>
                <td><input type="text" name="reclam" id="reclam" maxlength="255"></td>
            </tr>

            <tr align="center">
                <td>
                    <input type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
    <script>
        function validateForm() {
            var nom = document.getElementById("nom").value;
            var mail = document.getElementById("mail").value;
            var reclam = document.getElementById("reclam").value;

            if (nom === "") {
                alert("Veuillez saisir un nom.");
                return false;
            }

            if (mail === "") {
                alert("Veuillez saisir une adresse e-mail.");
                return false;
            } else if (!isValidEmail(mail)) {
                alert("Veuillez saisir une adresse e-mail valide.");
                return false;
            }

            if (reclam === "") {
                alert("Veuillez saisir une réclamation.");
                return false;
            }

            return true;
        }

        function isValidEmail(email) {
            // Expression régulière pour valider une adresse e-mail
            var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }
    </script>
</body>

</html>
