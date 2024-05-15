<?php
include "../Controller/ReponseC.php";
$ReponseC = new ReponseC();
$reponses = $ReponseC->ListReponses();
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>List ListReponses</title>
    <link rel="apple-touch-icon" sizes="76x76" href="../images/mostfa.png">
    <link rel="icon" type="image/png" href="../images/mostfa.png">
    <link rel="stylesheet" href="../Style/style.css">   
</head>
<body>
    <center>
        <h1>List of reponses</h1>
        <h2>
            <a href="addReponse.php">Add Reponse</a>
        </h2>
    </center>
    <table border="1" align="center" width="70%">
        <tr>
            <th>Id_rep</th>
            <th>Id_rec</th>
            <th>Reponse</th>
            <th>Modifier</th>
            <th>Supprimer</th>
            <th>Lire avec voix</th>
        </tr>
        <?php foreach ($reponses as $reponse) { ?>
            <tr>
                <td><?= $reponse['id_rep']; ?></td>
                <td><?= $reponse['id_rec']; ?></td>
                <td><?= $reponse['rep']; ?></td>
                <td align="center">
                    <form method="POST" action="updateReponse.php">
                        <input type="submit" name="update" value="Update">
                        <input type="hidden" value="<?= $reponse['id_rep']; ?>" name="id_rep">
                    </form>
                </td>
                <td align="center">
                    <form method="POST" action="deleteReponse.php">
                        <input type="submit" name="delete" value="Delete">
                        <input type="hidden" value="<?= $reponse['id_rep']; ?>" name="id_rep">
                    </form>
                </td>
                <td>
                    <div class="textContainer<?= $reponse['id_rep']; ?>"></div>
                    <button onclick="readText(<?= $reponse['id_rep']; ?>)">Lire le texte</button>
                </td>
            </tr>
        <?php } ?>
    </table>
    
    <script>
        function readText(id) {
            var textFromDatabase = document.querySelector('.textContainer' + id).innerText;
            var speechSynthesis = window.speechSynthesis;
            var speechText = new SpeechSynthesisUtterance(textFromDatabase);
            speechSynthesis.speak(speechText);
        }
    </script>
</body>
</html>
