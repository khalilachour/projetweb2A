<?php
require_once '../config.php';
require_once '../Controller/avantagesC.php';

// Récupérer l'identifiant de l'offre
$offre_id = isset($_GET['offre_id']) ? (int)$_GET['offre_id'] : null;

/*if (!$offre_id) {
    die("Erreur : L'identifiant de l'offre est manquant.");
}*/

$avantagesC = new AvantagesC();
$avantages = $avantagesC->afficherAvantages($offre_id); // Obtenir les avantages associés à l'offre

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Avantages de l'Offre</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
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
                        <a href="index.html" class="nav-item nav-link">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="service.html" class="nav-item nav-link">Service</a>
                        <a href="project.html" class="nav-item nav-link">Project</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="team.html" class="dropdown-item">Our Team</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                <a href="404.html" class="dropdown-item">404 Page</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <button type="button" class="btn text-secondary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></button>
                    <a href="https://htmlcodex.com/startup-company-website-template" class="btn btn-secondary text-light rounded-pill py-2 px-4 ms-3">Pro Version</a>
                </div>
            </nav>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Affichage des avantages pour une offre -->
        <div class="container my-5">
            
            <div class="row">
                <?php if (count($avantages) === 0) : ?>
                    <div class="col-12">
                        <p>Aucun avantage trouvé pour cette offre.</p>
                    </div>
                <?php else : ?>
                    <?php foreach ($avantages as $avantage) : ?>
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                
                                </div>
                                <div class="card-body">
                                    <p><strong>Description :</strong> <?= htmlspecialchars($avantage['description']) ?></p>
                                    <p><strong>Avantages sociaux :</strong> <?= htmlspecialchars($avantage['avantagesSociaux']) ?></p>
                                    <p><strong>Avantages financiers :</strong> <?= htmlspecialchars($avantage['avantagesFinanciers']) ?></p>
                                    <p><strong>Développement professionnel :</strong> <?= $avantage['developpementProfessionnel'] ? 'Oui' : 'Non' ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Footer Start -->
        <div class="container-fluid bg-primary text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row g-5">
                    <!-- sections du footer -->
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/isotope/isotope.pkgd.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>

        <!-- Template JavaScript -->
        <script src="js/main.js"></script>
    </div>
</body>

</html>