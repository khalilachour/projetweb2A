<?php

include "../Controller/ReclamationC.php";


$error = "";

//create reclamation
$Reclamation = null;

// create an instance of the controller
$ReclamationC = new ReclamationC();
if (
    isset($_POST["nom"]) && isset($_POST["mail"]) && isset($_POST["reclam"]) && isset($_POST["g-recaptcha-response"])
) {
    $captcha = $_POST["g-recaptcha-response"];
    $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfAjbQlAAAAAEfyCyxFNitj0JTxVG75IvD1c-Tt&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);

    if ($response['success'] == false) {
        $error = "Le reCAPTCHA a échoué. Veuillez réessayer.";
    } else if (
        !empty($_POST['nom']) && !empty($_POST['mail']) && !empty($_POST['reclam'])
    ) {
        // Vérifier que le nom ne contient pas de chiffres
        if (preg_match('/\d/', $_POST['nom'])) {
            $error = "Le nom ne doit pas contenir de chiffres !";
        }
        // Vérifier que l'adresse e-mail est valide
        else if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $error = "Adresse e-mail invalide !";
        }
        // Vérifier que la réclamation ne dépasse pas une certaine longueur
        else if (strlen($_POST['reclam']) > 1000) {
            $error = "La réclamation ne doit pas dépasser 1000 caractères";
        } else {
            $Reclamation = new Reclamation(
                null,
                $_POST['nom'],
                $_POST['mail'],
                $_POST['reclam']
            );
            $ReclamationC->addReclamation($Reclamation);
            header('Location: ListReclamations.php');
            exit();
        }
    } else {
        $error = "Tous les champs doivent être remplis !";
    }
}


?>

<html class="u-responsive-xl" lang="fr" style="font-size: 16px;"><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Welcome to job-flash ">
    <meta name="description" content="">
    <title>ListReclamations</title>
    <link rel="apple-touch-icon" sizes="76x76" href="../images/mostfa.png">
<link rel="icon" type="image/png" href="../images/mostfa.png">
    <link rel="stylesheet" href="../css/nicepage.css" media="screen">
    <link rel="stylesheet" href="../css/Reclamations.css" media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript" async="" src="https://www.gstatic.com/recaptcha/releases/V6_85qpc2Xf2sbe3xTnRte7m/recaptcha__fr.js" crossorigin="anonymous" integrity="sha384-keWnLYOCfE+aI3ZfqouTqAknw6OmlSMnjwIDC1AcAfpwNdIk80bC3as5JJTdrXAG"></script><script class="u-script" type="text/javascript" src="../js/jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="../js/nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 5.7.9, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">


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
    <script src="https://www.google.com/recaptcha/api.js"></script>

</head>
<body class="">
<header class="u-clearfix u-header u-header" id="sec-4e2d">
    <div class="u-clearfix u-sheet u-sheet-1">
        <a href="https://nicepage.com" class="u-image u-logo u-image-1" data-image-width="456" data-image-height="362">
            <img src="../images/mostfa.png" class="u-logo-image u-logo-image-1">
        </a>
        <nav class="u-menu u-menu-one-level u-offcanvas u-menu-1">
            <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px;">
                <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
                    <svg class="u-svg-link" viewBox="0 0 24 24">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use>
                    </svg>
                    <svg class="u-svg-content" version="1.1" id="menu-hamburger" viewBox="0 0 16 16" x="0px" y="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
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
                    <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="../index.html" style="padding: 10px 92px;">Accueil</a>
                    </li>
                   
                    <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="../Reclamations.html" style="padding: 10px 92px;">Reclamations</a>
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
                            
                            <li class="u-nav-item"><a class="u-button-style u-nav-link" href="../reclamation/Reclamation.php">Reclamations</a>
                            </li>
                           
                        </ul>
                    </div>
                </div>
                <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
            </div>
        <style class="offcanvas-style">            .u-offcanvas .u-sidenav { flex-basis: 250px !important; }            .u-offcanvas:not(.u-menu-open-right) .u-sidenav { margin-left: -250px; }            .u-offcanvas.u-menu-open-right .u-sidenav { margin-right: -250px; }            @keyframes menu-shift-left    { from { left: 0;        } to { left: 250px;  } }            @keyframes menu-unshift-left  { from { left: 250px;  } to { left: 0;        } }            @keyframes menu-shift-right   { from { right: 0;       } to { right: 250px; } }            @keyframes menu-unshift-right { from { right: 250px; } to { right: 0;       } }            </style></nav>
    </div>
</header>
<section class="skrollable skrollable-between u-align-center u-clearfix u-image u-shading u-section-1" id="carousel_984b" src="" data-image-width="1980" data-image-height="1320">
         
         <a href="ListReclamations.php">Back to list </a>
    <hr>

    <div id="error">
            </div>
    <div class="Reclamez">
<h1>Reclamez !</h1>
<p>Un problème ?, envie de nous envoyer un message à propos un problème ? N’hésitez pas !</p>
</div>
    <form action="" method="POST" onsubmit="return controle_de_saisie()">
        <table border="1" align="center">

            <tbody><tr>
                <td>
                    <label for="nom">Votre nom:
                    </label>
                </td>
                <td><input type="text" name="nom" id="nom" maxlength="20"></td>
            </tr>

            <tr>
                <td>
                    <label for="mail">Votre E-mail:
                    </label>
                </td>
                <td><input type="text" name="mail" id="mail" maxlength="255"></td>
            </tr>

            <tr>
            <td>
                <label for="reclam">Votre reclamation:
                </label>
            </td>
            <td><textarea name="reclam" id="reclam" cols="30" rows="10" oninput="censorInput()"></textarea></td>
        </tr>
        <tr>
           
            <td><label for="reclam">Vérification humaine:</label></td>
            <td><div class="g-recaptcha" data-sitekey="6LfAjbQlAAAAAFkh99lGDJlf9omUlZSP3ByQAcXa"></div>
        

            <tr align="center" color="white">
                <td>
                <input type="submit" class="u-border-1 u-border-grey-75 u-border-hover-white u-btn u-btn-round u-button-style u-gradient u-none u-radius-50 u-text-body-alt-color" value="Envoyer">

                </td>
                <td>
                    <input type="reset" class="u-border-1 u-border-grey-75 u-border-hover-white u-btn u-btn-round u-button-style u-gradient u-none u-radius-50 u-text-body-alt-color" value="Reset">
                </td>
            </tr>
        </tbody></table>
    </form>
    <script>
    function controle_de_saisie() {
        var nom = document.getElementById('nom').value;
        var mail = document.getElementById('mail').value;
        var reclam = document.getElementById('reclam').value;

        // Vérification du champ nom
        if (nom.trim() == "") {
            alert("Veuillez entrer votre nom.");
            return false;
        }

        // Vérification du champ e-mail
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(mail)) {
            alert("Veuillez entrer une adresse e-mail valide.");
            return false;
        }

        // Vérification du champ réclamation
        if (reclam.trim() == "") {
            alert("Veuillez entrer votre réclamation.");
            return false;
        }

        // Si tout est valide, le formulaire peut être soumis
        return true;

    }
    function censorInput() {
    var reclam = document.getElementById("reclam");
    var inputValue = reclam.value;
    var badWords = ["5ayeb", "sa9et", "mauvais"]; // Ajoutez ici vos mots à censurer
    
    // Remplace chaque mauvais mot par des "*"
    for (var i = 0; i < badWords.length; i++) {
        var regex = new RegExp(badWords[i], "gi");
        inputValue = inputValue.replace(regex, "#".repeat(badWords[i].length));
    }
    
    // Vérifie s'il y a des mots censurés
    if (inputValue !== reclam.value) {
        alert("Il est interdit d'écrire des mots inappropriés.");
        
    }


    
    // Met à jour la valeur du champ de saisie
    reclam.value = inputValue;}
</script>
    <div class="u-clearfix u-sheet u-valign-middle-xs u-sheet-1">
        <img class="u-image u-image-circle u-image-contain u-image-1" src="images/mostfa.png" alt="" data-image-width="456" data-image-height="362">
            </div>
</section>
<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-f3c2">
    <div class="u-clearfix u-sheet u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">contacter iyed gharsalli pour plus d'informations</p>
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
        <span>adem sahbanni</span>
    </a>.
</section>  
