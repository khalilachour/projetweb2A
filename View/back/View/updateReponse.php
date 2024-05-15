<?php

include '../Controller/ReponseC.php';

$error = "";

//create reponse
$reponse = null;

// create an instance of the controller
$reponseC = new reponseC();
if (
    isset($_POST["id_rep"]) && 
    isset($_POST["id_rec"]) && 
    isset($_POST["rep"]) 
) {
    if ( 
        !empty($_POST["id_rep"]) && 
        !empty($_POST["id_rec"]) && 
        !empty($_POST["rep"])
    ) {
        $reponse = new Reponse(
            $_POST['id_rep'],
            $_POST['id_rec'],
            $_POST['rep']
        );
        $reponseC->updateReponse($reponse, $_POST["id_rep"]);
        header('Location:ListReponses.php');
    } else 
    $error = "Missing information";
}
?>

<html lang="en">

<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>updateReponse</title>
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

        <h1>Modifier reponse</h1>
    </center>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id_rep'])) {
        $reponse= $reponseC->showReponse($_POST['id_rep']);

    ?>

        <form action="" method="POST">
            <table border="1" align="center">
                <tr>
                    <td>
                        <label for="id_rep">id_rep:
                        </label>
                    </td>
                    <td><input type="text" name="id_rep" id="id_rep" value="<?php echo $reponse['id_rep']; ?>" maxlength="20"></td>
                </tr>
                <tr>
                    <td>
                        <label for="id_rec">Id_rec:
                        </label>
                    </td>
                    <td><input type="text" name="id_rec" id="id_rec" value="<?php echo $reponse['id_rec']; ?>" maxlength="20"></td>
                </tr>
                <tr>
                    <td>
                        <label for="rep">Reponse:
                        </label>
                    </td>
                    <td><input type="text" name="rep" id="rep" value="<?php echo $reponse['rep']; ?>" maxlength="255"></td>
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
 
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">

<div class="sidenav-header">
  <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
  <a class="navbar-brand m-0" href="../index.html" target="_blank">
    <img src="./assets/img/logo-ct.png" class="navba-brand-img h-100" alt="main_logo">
    <span class="ms-1 font-weight-bold text-white">I-Camp administation </span>
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
<!--   Core JS Files   -->
<script src="./assets/js/core/popper.min.js" ></script>
<script src="./assets/js/core/bootstrap.min.js" ></script>
<script src="./assets/js/plugins/perfect-scrollbar.min.js" ></script>
<script src="./assets/js/plugins/smooth-scrollbar.min.js" ></script>
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


<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc --><script src="./assets/js/material-dashboard.min.js?v=3.0.5"></script>
  </body>

</html>