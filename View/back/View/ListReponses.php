<?php
include "../Controller/ReponseC.php";
$ReponseC = new ReponseC();
$list = $ReponseC->ListReponses();
?>


<html>

<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <title>ListReponses</title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

  <script>
function searchTable() {
  // Récupérer la valeur saisie par l'utilisateur
  var input = document.getElementById("searchInput").value;
  // Récupérer le tableau
  var table = document.getElementById("reponseTable");
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

function sortTable() {
    var table = document.getElementById("reponseTable");
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
function readText(id) {
    var textFromDatabase = document.querySelector('.textContainer' + id).innerText;
    console.log('Texte à lire :', textFromDatabase); // Débogage
    var speechSynthesis = window.speechSynthesis;
    var speechText = new SpeechSynthesisUtterance(textFromDatabase);
    speechSynthesis.speak(speechText);
}
// Get the name of the client from the database
function getClientName() {
  // Make an AJAX request to the server to get the client name
  // For example, you can use the Fetch API or jQuery's $.ajax() function
  // Here's an example using Fetch API:
  return fetch('get_client_name.php')
    .then(response => response.json())
    .then(data => data.clientName);
}

// Generate the QR code

        // Function to generate the QR code
        function generateQRCode(text) {
            // The URL you want to encode in the QR code
            var url = text ;

            // The element where the QR code will be displayed
            var qrcode = new QRCode(document.getElementById("qrcode"), {
                text: url,
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        }
    </script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />    
</head>

<body class="g-sidenav-show  bg-gray-100">
  <center>
        <h1>Liste des reponses :</h1>
        <h2>
            <a href="addReponse.php">Ajouter  Réponse</a>
        </h2>
        <div>
  <input type="text" id="searchInput" onkeyup="searchTable()" style="background-color: white; color: black;" placeholder="RECHERCHER...">
</div>
<div><button onclick="sortTable()" style="background-color: white; color: black;">TRIER </button></div>   
<br>    
    </center>
  <table class="table align-items-center mb-0" align="center">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id_rep</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Id_rec</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Reponse</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Modifier</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Supprimer</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">qr code </th>
                  </tr>
                </thead>
                <tbody id="reponseTable">
        <?php
        foreach ($list as $Reponse) {
        ?>
            <tr>
                <td><?= $Reponse['id_rep']; ?></td>
                <td><?= $Reponse['id_rec']; ?></td>
                <td><?= $Reponse['rep']; ?></td>

                <td align="center">
                    <form method="POST" action="updateReponse.php">
                        <input type="submit" name="update" value="Update">
                        <input type="hidden" value=<?PHP echo $Reponse['id_rep']; ?> name="id_rep">
                    </form>
                </td>
                <td align="center">
                    <form method="POST" action="deleteReponse.php">
                        <input type="submit" name="delete" value="Delete">
                        <input type="hidden" value=<?PHP echo $Reponse['id_rep']; ?> name="id_rep">
                    </form>
                </td>
                <td>
                    <a href="deleteReponse.php?id=<?php echo $Reponse['id_rep']; ?>"><img src="../images/trash.png" alt=""></a>
                </td>
                <td>
                <button onclick="generateQRCode('<?= $Reponse['rep']; ?>')">Générer QR Code</button>
                 <div id="qrcode" title="<?= $Reponse['rep']; ?>">
                 <canvas width="50" height="50" style="display: none;">
                </canvas>
                   </div>

                
             
                     
                      <div class="qrcode text-center" id="qrcode<?= $Reponse['id_rep']; ?>" style="display: none;">
                        <canvas id="qrcodeCanvas<?= $Reponse['id_rep']; ?>" width="150" height="150"></canvas>
                        <img src="" alt="QR Code" id="qrcodeImg<?= $Reponse['id_rep']; ?>" style="width: 150px; height: 150px; display: none;">
                      </div>
                    </td>
            </tr>
        <?php
        }
        ?>
    </table>
    

    
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
    var qrcode;
    function generateQRCode(text) {
      var qrcodeCanvas = document.getElementById("qrcodeCanvas" + this.id);
      qrcode = new QRCode(qrcodeCanvas, {
        text: text,
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
      })\
    }
    function showQRCode(id) {
      var qrcodeImg = document.getElementById("qrcodeImg" + id);
      qrcodeImg.src = qrcode.toDataURL(2);
      qrcodeImg.style.display = "block";
    }
    function hideQRCode(id) {
      var qrcodeImg = document.getElementById("qrcodeImg" + id);
      qrcodeImg.src = "";
      qrcodeImg.style.display = "none"
    }
  </script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>


<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc --><script src="./assets/js/material-dashboard.min.js?v=3.0.5"></script>
  </body>

</html>
