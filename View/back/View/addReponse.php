<?php
require_once "../Controller/ReponseC.php";
require_once "../vendor/autoload.php"; 


$error = "";
$Reponse = null;
$ReponseC = new ReponseC();

if (isset($_POST["id_rec"]) && isset($_POST["rep"])) {
    if (empty($_POST['id_rec'])) {
        $error .= "Il faut choisir un id de réclamation. ";
    }
    if (empty($_POST['rep'])) {
        $error .= "Il faut remplir le champ de réponse. ";
    }
    if (empty($error)) {
        $Reponse = new Reponse( null, $_POST['id_rec'],
            $_POST['rep']
        );
        $ReponseC->addReponse($Reponse);

        // Get the email address of the writer of the claim
        $connexion = mysqli_connect("localhost", "root","", "educatous");
        $result = mysqli_query($connexion, "SELECT mail FROM reclamations WHERE id_rec = {$_POST['id_rec']}");
        $row = mysqli_fetch_assoc($result);
        $writer_email = filter_var($row['mail'], FILTER_SANITIZE_EMAIL);

        $mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP(); // or any other transport protocol you prefer
$mail->Host = 'smtp.gmail.com'; // or any other SMTP server you prefer
$mail->SMTPAuth = true;
$mail->Username = 'testmailing178@gmail.com'; // votre adresse email
$mail->Password = 'iyed1234';
$mail->SMTPSecure = 'SSL'; // or 'ssl'ou tls if your SMTP server requires it
$mail->Port = 465; // or any other port your SMTP server uses
$mail->setFrom('testmailing178@gmail.com', 'iyed gharsalli'); // your name and email address
$mail->addAddress($writer_email); // recipient email address
$mail->Subject = 'Reponse à votre réclamation';
$mail->Body = 'Votre demande avec ID ' . $_POST['id_rec'] . ' a été traitée.  Veuillez consulter notre site web pour voir la réponse. educatous ';

// Send the email
if ($mail->send()) {
  header('Location: ListReponses.php');
  exit();
} else {
  echo 'Erreur lors de l\'envoi d\'email : ' . $mail->ErrorInfo;
}


    }
}
?>




<html lang="en">

<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
Add Reponse
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" /> 
</head>
<body class="g-sidenav-show  bg-gray-100">
  <br><br><br>
<center>
<a href="ListReponses.php">Back to list </a>

        <h1>Ajouter réponse</h1>
    </center>
    <hr>
<center>
<div id="error">
        <?php echo $error; ?>
    </div>

</center>

  
    <form action="" method="POST" onsubmit="return validateForm()">
        <table border="1" align="center">

           <tr>
    <td>
        <label for="id_rec">id_rec:</label>
    </td>
    <td>
        <select name="id_rec" id="id_rec">
            <?php
            $connexion = mysqli_connect("localhost", "root", "", "educatous");
            $resultat = mysqli_query($connexion, "SELECT id_rec FROM reclamations WHERE id_rec NOT IN (SELECT id_rec FROM reponses)");
            while ($row = mysqli_fetch_assoc($resultat)) {
                echo "<option value='" . $row['id_rec'] . "'>" . $row['id_rec'] . "</option>";
            }
            ?>
        </select>
    </td>
</tr>

            <tr>
                <td>
                    <label for="rep">reponse:
                    </label>
                </td>
                <td><input type="text" name="rep" id="rep" maxlength="255"></td>
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
            var id_rec = document.getElementById("id_rec").value;
            var rep = document.getElementById("rep").value;

            if (id_rec === "") {
                alert("Veuillez sélectionner un ID réclamation.");
                return false;
            }

            if (rep === "") {
                alert("Veuillez saisir une réponse.");
                return false;
            }

            return true;
        }
    </script>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">

<div class="sidenav-header">
  <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
  <a class="navbar-brand m-0" href="../index.html" target="_blank">
   
    <span class="ms-1 font-weight-bold text-white">job-flash administation </span>
  </a>
</div>


<hr class="horizontal light mt-0 mb-2">

<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
  <ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link text-white " href="ListReclamations.php">
  
    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
    </div>
  
  <span class="nav-link-text ms-1">Reclamations</span>
</a>
</li>


<li class="nav-item">
<a class="nav-link text-white " href="ListReponses.php">
  
    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
    </div>
  
  <span class="nav-link-text ms-1">Reponses</span>
</a>
</li>

 
                <footer>
  
</footer>

            </div>

         
       </main>


<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>



  </body>

</html>