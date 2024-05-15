<?php

include '../Controller/ReclamationC.php';

$error = "";

//create reclamation
$reclamation = null;

// create an instance of the controller
$reclamationC = new reclamationC();
if (
    isset($_POST["id_rec"]) && 
    isset($_POST["nom"]) && 
    isset($_POST["mail"]) && 
    isset($_POST["reclam"])
) {
    if ( 
        !empty($_POST["id_rec"]) && 
        !empty($_POST["nom"]) && 
        !empty($_POST["mail"]) && 
        !empty($_POST["reclam"])
    ) {
        $reclamation = new Reclamation(
            $_POST['id_rec'],
            $_POST['nom'],
            $_POST['mail'],
            $_POST['reclam']
        );
        $reclamationC->updateReclamation($reclamation, $_POST["id_rec"]);
        header('Location:ListReclamations.php');
    } else 
    $error = "Missing information";
}
?>

<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update reclamation</title>
    <link rel="stylesheet" href="../Style/style.css">
</head>

<body>
    <button><a href="ListReclamations.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id_rec'])) {
        $reclamation= $reclamationC->showReclamation($_POST['id_rec']);

    ?>

        <form action="" method="POST">
            <table border="1" align="center">
                <tr>
                    <td>
                        <label for="id_rec">Id:
                        </label>
                    </td>
                    <td><input type="text" name="id_rec" id="id_rec" value="<?php echo $reclamation['id_rec']; ?>" maxlength="20"></td>
                </tr>
                <tr>
                    <td>
                        <label for="nom">Nom:
                        </label>
                    </td>
                    <td><input type="text" name="nom" id="nom" value="<?php echo $reclamation['nom']; ?>" maxlength="255"></td>
                </tr>
                <tr>
                    <td>
                        <label for="mail">Email:
                        </label>
                    </td>
                    <td><input type="text" name="mail" id="mail" value="<?php echo $reclamation['mail']; ?>" maxlength="255"></td>
                </tr>
                <tr>
                    <td>
                        <label for="reclam">Reclamation:
                        </label>
                    </td>
                    <td><input type="text" name="reclam" id="reclam" value="<?php echo $reclamation['reclam']; ?>" maxlength="255"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Update">
                    </td>
                    <td>
                        <input type="reset" value="Reset">
                    </td>
                </tr>
            </table>
        </form>
    <?php
    }
    ?>
</body>

</html>