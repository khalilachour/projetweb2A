<?php
/*
include 'C:/xampp/htdocs/nouveau/controller/candC.php';

$CC = new CandidatureController(); // Création de l'instance du contrôleur

if(isset($_POST['id_offre'],$_POST['date'],$_POST['cv'],$_POST['lettre'])){
    // Création d'une instance de Candidature avec les données du formulaire
    $candidature = new Candidature($_POST['id_offre'], $_POST['date'], $_POST['cv'], $_POST['lettre']);
    // Appel de la méthode addCandidature du contrôleur
    $CC->addCandidature($candidature->getIdOffre(), $candidature->getDate(), $candidature->getCv(), $candidature->getLettre());
    //header('location: afficher_cand.php');
    $id_candidature = $CC->getLastInsertedId(); // Supposons que cette méthode renvoie l'id de la dernière candidature ajoutée
    
    // Redirection vers add_comp.php avec l'id de la candidature
    header('location: add_comp.php?id_candidature=' . $id_candidature);
}
*/
?>

<?php

date_default_timezone_set('Africa/Tunis');
$currentDateTime = date('Y-m-d');
//echo "$currentDateTime";

include 'C:/xampp/htdocs/nouveau/controller/candC.php';

$CC = new CandidatureController(); // Création de l'instance du contrôleur

if(isset($_POST['id_offre'],$_POST['date'],$_FILES['cv'],$_FILES['lettre'])){
    // Répertoire de destination pour les fichiers uploads
    $uploadDirectory = 'C:/xampp/htdocs/nouveau/uploads/';

    // Vérification et traitement du fichier CV
    if($_FILES['cv']['name'] != '') {
        $cvFileName = $uploadDirectory . basename($_FILES["cv"]["name"]);
        move_uploaded_file($_FILES["cv"]["tmp_name"], $cvFileName);
    } else {
        $cvFileName = ''; // Aucun fichier CV téléchargé, garder le champ vide
    }

    // Vérification et traitement du fichier Lettre de motivation
    if($_FILES['lettre']['name'] != '') {
        $lettreFileName = $uploadDirectory . basename($_FILES["lettre"]["name"]);
        move_uploaded_file($_FILES["lettre"]["tmp_name"], $lettreFileName);
    } else {
        $lettreFileName = ''; // Aucun fichier Lettre téléchargé, garder le champ vide
    }

    // Création d'une instance de Candidature avec les données du formulaire
    $candidature = new Candidature($_POST['id_offre'], $_POST['date'], $cvFileName, $lettreFileName);
    
    // Appel de la méthode addCandidature du contrôleur
    $CC->addCandidature($candidature->getIdOffre(), $candidature->getDate(), $candidature->getCv(), $candidature->getLettre());
    
    // Supposons que cette méthode renvoie l'id de la dernière candidature ajoutée
    $id_candidature = $CC->getLastInsertedId();
    
    // Redirection vers add_comp.php avec l'id de la candidature
    header('location: add_comp.php?id_candidature=' . $id_candidature);
}

?>
















<!--
<form method="post">
    <input type="text" value="1" name="id_offre">
    <input type="date" name="date">
    <input type="file" placeholder="CV" name="cv">
    <input type="file" placeholder="lettre de motivation" name="lettre">
    <input type="submit" value="Ajouter">
</form>-->













<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SEO Master - SEO Agency Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="/nouveau/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/nouveau/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/nouveau/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/nouveau/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/nouveau/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/nouveau/css/style.css" rel="stylesheet">
</head>

<body>

    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0"><i class="fa fa-search me-2"></i>SEO<span class="fs-5">Master</span></h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="../index.html" class="nav-item nav-link">Home</a>
                        <a href="../about.html" class="nav-item nav-link">About</a>
                        <a href="../service.html" class="nav-item nav-link">Service</a>
                        <a href="../project.html" class="nav-item nav-link">Project</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="../team.html" class="dropdown-item">Our Team</a>
                                <a href="../testimonial.html" class="dropdown-item">Testimonial</a>
                                <a href="../404.html" class="dropdown-item">404 Page</a>
                            </div>
                        </div>
                        <a href="../contact.html" class="nav-item nav-link active">Contact</a>
                    </div>
                    <butaton type="button" class="btn text-secondary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></butaton>
                    <a href="https://htmlcodex.com/startup-company-website-template" class="btn btn-secondary text-light rounded-pill py-2 px-4 ms-3">Pro Version</a>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-primary hero-header mb-5">
                <div class="container my-5 py-5 px-lg-5">
                    <div class="row g-5 py-5">
                        <div class="col-12 text-center">
                            <h1 class="text-white animated zoomIn">Candidatures</h1>
                            <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                            <!--
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                                    <li class="breadcrumb-item text-white active" aria-current="page">Contact</li>
                                </ol>
                            </nav>
-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->


        <!-- Full Screen Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content" style="background: rgba(29, 29, 39, 0.7);">
                    <div class="modal-header border-0">
                        <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center">
                        <div class="input-group" style="max-width: 600px;">
                            <input type="text" class="form-control bg-transparent border-light p-3" placeholder="Type search keyword">
                            <button class="btn btn-light px-4"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Full Screen Search End -->


        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container px-lg-5">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                          <!--  
                        <h6 class="position-relative d-inline text-primary ps-4">Contact Us</h6>-->
                            <h2 class="mt-2"><a class="btn btn-link" href="add_cand.php">Postuler</a></h2>
                            <h2 class="mt-2"><a class="btn btn-link" href="afficher_cand.php">Voir Candidatures</a></h2>
                        </div>
                        <div class="wow fadeInUp" data-wow-delay="0.3s">
                            <form method="post" enctype="multipart/form-data">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="hidden" type="text" placeholder="id_offre" value="1" name="id_offre" class="form-control" id="name">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input readonly type="date" name="date" class="form-control" id="email" placeholder="Your Email" value="<?php echo $currentDateTime ?>">
                                            
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input  type="file" placeholder="CV" name="cv" class="form-control" id="subject">
                                            <label for="subject">CV</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="file" placeholder="lettre de motivation" name="lettre" class="form-control" id="message" style="height: 150px"></input>
                                            <label for="message">Lettre de motivation</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit">Ajouter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
        

        <!-- Footer Start -->
        <div class="container-fluid bg-primary text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Get In Touch</h5>
                        <p><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p><i class="fa fa-envelope me-3"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Popular Link</h5>
                        <a class="btn btn-link" href="">About Us</a>
                        <a class="btn btn-link" href="">Contact Us</a>
                        <a class="btn btn-link" href="">Privacy Policy</a>
                        <a class="btn btn-link" href="">Terms & Condition</a>
                        <a class="btn btn-link" href="">Career</a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Project Gallery</h5>
                        <div class="row g-2">
                            <div class="col-4">
                                <img class="img-fluid" src="/nouveau/img/portfolio-1.jpg" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="/nouveau/img/portfolio-2.jpg" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="/nouveau/img/portfolio-3.jpg" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="/nouveau/img/portfolio-4.jpg" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="/nouveau/img/portfolio-5.jpg" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="/nouveau/img/portfolio-6.jpg" alt="Image">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Newsletter</h5>
                        <p>Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulpu</p>
                        <div class="position-relative w-100 mt-3">
                            <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" placeholder="Your Email" style="height: 48px;">
                            <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i class="fa fa-paper-plane text-primary fs-4"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved. 
							
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="../">Home</a>
                                <a href="../cookies">Cookies</a>
                                <a href="../help">Help</a>
                                <a href="../faqs">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/nouveau/lib/wow/wow.min.js"></script>
    <script src="/nouveau/lib/easing/easing.min.js"></script>
    <script src="/nouveau/lib/waypoints/waypoints.min.js"></script>
    <script src="/nouveau/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="/nouveau/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="/nouveau/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="/nouveau/scripttemplate.js"></script>
</body>
</html>
