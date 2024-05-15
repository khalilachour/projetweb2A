
<?php
include '../Controller/ReclamationC.php';

$ReclamationC = new ReclamationC();

if (isset($_POST['delete'])) {
    $id_rec = $_POST['id_rec'];
    $ReclamationC->deleteReclamation($id_rec);
}

header('Location: listReclamations.php');