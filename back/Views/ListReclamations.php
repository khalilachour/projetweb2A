<?php
include "../Controller/ReclamationC.php";
$ReclamationC = new ReclamationC();
$list = $ReclamationC->ListReclamations();
?>


<html>

<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  
  <title>
ListReclamations
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script>
function searchTable() {
  // Récupérer la valeur saisie par l'utilisateur
  var input = document.getElementById("searchInput").value;
  // Récupérer le tableau
  var table = document.getElementById("reclamationTable");
  // Récupérer les lignes du tableau
  var rows = table.getElementsByTagName("tr");
  // Parcourir les lignes du tableau, en commençant par la 1ère ligne (les en-têtes)
  for (var i = 1; i < rows.length; i++) {
    // Récupérer les cellules de la ligne
    var cells = rows[i].getElementsByTagName("td");
    // Initialiser une variable qui va déterminer si la ligne correspond à la recherche de l'utilisateur
    var found = false;
    // Parcourir les cellules de la ligne
    for (var j = 0; j < cells.length; j++) {
      // Si la valeur de la cellule contient la valeur saisie par l'utilisateur, alors la ligne correspond à la recherche
      if (cells[j].innerHTML.toLowerCase().indexOf(input.toLowerCase()) > -1) {
        found = true;
        break;
      }
    }
    // Afficher ou masquer la ligne en fonction de si elle correspond ou non à la recherche
    if (found) {
      rows[i].style.display = "";
    } else {
      rows[i].style.display = "none";
    }
  }
}
</script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" /> 
</head>
<body class="g-sidenav-show  bg-gray-100">
  <br><br><br>
<center>
        <h1>List of reclamations</h1>
        <div>
  <input type="text" id="searchInput" onkeyup="searchTable()" style="background-color: white; color: black;" placeholder="RECHERCHER...">
</div>
<br>
<div><button onclick="sortTable()" style="background-color: white; color: black;">TRIER </button></div>
<br>
    </center>
    <table id="reclamationTable" border="1" align="center" width="50%">
        <tr>
            <th> Nom</th>
            <th>Email</th>
            <th>Reclamation</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php
        foreach ($list as $Reclamation) {
        ?>
            <tr>
                <td><?= $Reclamation['nom']; ?></td>
                <td><?= $Reclamation['mail']; ?></td>
                <td><?= $Reclamation['reclam']; ?></td>

                <td align="center">
                    <form method="POST" action="updateReclamation.php">
                        <input type="submit" name="update" value="Update">
                        <input type="hidden" value=<?PHP echo $Reclamation['id_rec']; ?> name="id_rec">
                    </form>
                </td>
                <td align="center">
                    <form method="POST" action="deleteReclamation.php">
                        <input type="submit" name="delete" value="Delete">
                        <input type="hidden" value=<?PHP echo $Reclamation['id_rec']; ?> name="id_rec">
                    </form>
                </td>
                <td align="center">
                    <form method="POST" action="addReponse.php">
                        <input type="submit" name="delete" value="Repondre">
                        <input type="hidden" value=<?PHP echo $Reclamation['id_rec']; ?> name="id_rec">
                    </form>
                </td>
                
            </tr>
        <?php
        }
        ?>
    </table>
    <script>
    function sortTable() {
        var table = document.getElementById("reclamationTable");
        var rows = Array.prototype.slice.call(table.tBodies[0].rows, 1); // Start sorting from the second row

        rows.sort(function(a, b) {
            return a.cells[0].innerHTML.localeCompare(b.cells[0].innerHTML);
        });

        if (table.getAttribute("data-sort-order") === "asc") {
            rows.reverse();
            table.setAttribute("data-sort-order", "desc");
        } else {
            table.setAttribute("data-sort-order", "asc");
        }

        for (var i = 0; i < rows.length; i++) {
            table.tBodies[0].appendChild(rows[i]);
        }
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