
<?php
include '../Controller/ReponseC.php';

$ReponseC = new ReponseC();

if (isset($_POST['delete'])) {
    $id_rep = $_POST['id_rep'];
    $ReponseC->deleteReponse($id_rep);
}

header('Location: listReponses.php');