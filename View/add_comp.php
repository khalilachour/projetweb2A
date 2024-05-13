<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body>
<?php
require_once 'C:/xampp/htdocs/projet/Controller/compC.php';

$CC = new CompetenceController(); // Création de l'instance du contrôleur

if(isset($_POST['id_candidature'],$_POST['nom'],$_POST['niveau'],$_POST['description'])){
    
    // Création d'une instance de Competence avec les données du formulaire
    $competence = new Competence($_POST['id_candidature'], $_POST['nom'], $_POST['niveau'], $_POST['description']);
    // Appel de la méthode addCompetence du contrôleur
    $CC->addCompetence($competence->getIdCand(), $competence->getNom(), $competence->getNiveau(), $competence->getDescription());
    
    //header('location: afficher_comp.php?id_candidature=' . $_POST['id_candidature']);
    
}

?>


<!--
<form id="myForm" method="post">
    <input type="" name="id_candidature" value="<?php echo $_GET['id_candidature']; ?>">
    <input type="text" name="nom" placeholder="Nom de la compétence">
    <div id="errorMessage"></div>
    <input type="text" name="niveau" placeholder="Niveau de la compétence">
    <textarea id="descriptionInput" name="description" placeholder="Description de la compétence"></textarea>
    <div id="descriptionError"></div>
    <input type="submit" value="Ajouter">
</form>
    <script src="../script.js"></script>
</body>
</html>
-->



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
                            <form id="myForm" method="post">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input placeholder="id_cand" type="hidden" name="id_candidature" value="<?php echo $_GET['id_candidature']; ?>" class="form-control" id="name">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <label for="nom">Nom de la compétence</label>
                                            <input type="text" name="nom"  class="form-control"  placeholder="Nom de la compétence" >
                                            <div id="errorMessage"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                        
                                            <!--<input  type="text" name="niveau" placeholder="Niveau de la compétence" class="form-control" id="subject">
--> <select id="niveau" name="niveau" class="form-control">
                                                <option value="debutant">Débutant</option>
                                                <option value="intermediaire">Intermédiaire</option>
                                                <option value="avance">Avancé</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                        <textarea id="descriptionInput" name="description" placeholder="Description de la compétence"></textarea>
                                        <div id="descriptionError"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit">Ajouter</button>
                                    </div>
                                </div>
                            </form>
                            <script src="../script.js"></script>
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
    <script src="/projet/scripttemplate.js"></script>
    <script src="/projet/script.js"></script>
</body>
</html>
