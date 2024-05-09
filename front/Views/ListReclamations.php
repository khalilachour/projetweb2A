<?php
include "../Controller/ReclamationC.php";
$ReclamationC = new ReclamationC();
$list = $ReclamationC->ListReclamations();
?>


<html>
<html style="font-size: 16px;" lang="fr">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Welcome to I-CAMP ">
    <meta name="description" content="">
    <title>ListReclamations</title>
    <link rel="apple-touch-icon" sizes="76x76" href="../images/mostfa.png">
<link rel="icon" type="image/png" href="../images/mostfa.png">
    <link rel="stylesheet" href="../css/nicepage.css" media="screen">
    <link rel="stylesheet" href="../css/Reclamations.css" media="screen">
    <script class="u-script" type="text/javascript" src="../js/jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="../js/nicepage.js" defer=""></script>
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

    <meta name="generator" content="Nicepage 5.7.9, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">


    <script type="application/ld+json">{
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "Site1",
        "logo": "../images/mostfa.png"
    }</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Reclamations">
    <meta property="og:type" content="website">
    <meta data-intl-tel-input-cdn-path="../intlTelInput/">
</head>

<body>
<header class="u-clearfix u-header u-header" id="sec-4e2d">
    <div class="u-clearfix u-sheet u-sheet-1">
        <a href="https://nicepage.com" class="u-image u-logo u-image-1" data-image-width="456" data-image-height="362">
            <img src="../images/mostfa.png" class="u-logo-image u-logo-image-1">
        </a>
        <nav class="u-menu u-menu-one-level u-offcanvas u-menu-1">
            <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px;">
                <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base"
                   href="#">
                    <svg class="u-svg-link" viewBox="0 0 24 24">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use>
                    </svg>
                    <svg class="u-svg-content" version="1.1" id="menu-hamburger" viewBox="0 0 16 16" x="0px" y="0px"
                         xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <rect y="1" width="16" height="2"></rect>
                            <rect y="7" width="16" height="2"></rect>
                            <rect y="13" width="16" height="2"></rect>
                        </g>
                    </svg>
                </a>
            </div>
            <div class="u-custom-menu u-nav-container">
                <ul class="u-nav u-unstyled u-nav-1">
                    <li class="u-nav-item"><a
                            class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base"
                            href="../index.html" style="padding: 10px 92px;">Accueil</a>
                    </li>
                    
                    <li class="u-nav-item"><a
                            class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base"
                            href="../Reclamations.html" style="padding: 10px 92px;">Reclamations</a>
                    </li>
                 
                    </li>
                </ul>
            </div>
            <div class="u-custom-menu u-nav-container-collapse">
                <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
                    <div class="u-inner-container-layout u-sidenav-overflow">
                        <div class="u-menu-close"></div>
                        <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2">
                            <li class="u-nav-item"><a class="u-button-style u-nav-link" href="../index.html">Accueil</a>
                            </li>
                            
                            </li>
                            <li class="u-nav-item"><a class="u-button-style u-nav-link" href="../reclamation/Reclamation.php">Reclamations</a>
                            </li>
                            
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
            </div>
        </nav>
    </div>
</header>
<section class="skrollable skrollable-between u-align-center u-clearfix u-image u-shading u-section-1"
         id="carousel_984b" src="" data-image-width="1980" data-image-height="1320">
         <center>
        
        <h2>
            <a href="addReclamation.php"class="u-border-1 u-border-grey-75 u-border-hover-white u-btn u-btn-round u-button-style u-gradient u-none u-radius-50 u-text-body-alt-color u-btn-1">Ajouter Reclamation</a>
        </h2>
    <div class="u-clearfix u-sheet u-valign-middle-xs u-sheet-1">
        <img class="u-image u-image-circle u-image-contain u-image-1" src="images/mostfa.png" alt=""
             data-image-width="456" data-image-height="362">
            </div>
</section>
<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-f3c2">
    <div class="u-clearfix u-sheet u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Exemple de texte. Cliquez pour sélectionner l'élément de
            texte.</p>
    </div>
</footer>
<section class="u-backlink u-clearfix u-grey-80">
    <a class="u-link" href="https://nicepage.com/website-templates" target="_blank">
        <span>Website Templates</span>
    </a>
    <p class="u-text">
        <span>created with</span>
    </p>
    <a class="u-link" href="" target="_blank">
        <span>Website Builder Software</span>
    </a>.
</section>  
</body>

</html>