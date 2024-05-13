<?php
require_once '../config.php';
require_once '../Controller/avantagesC.php';
require_once '../Model/avantages.php';

$avantagesC = new AvantagesC();

// Récupérer `offre_id` de l'URL
$offre_id = isset($_GET['offre_id']) ? (int)$_GET['offre_id'] : null;

// Si `offre_id` est absent, afficher une erreur
/*if ($offre_id === null) {
    echo "Erreur : Identifiant de l'offre non fourni.";
    exit;
}*/

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    $avantagesSociaux = $_POST['avantagesSociaux'];
    $avantagesFinanciers = $_POST['avantagesFinanciers'];
    $developpementProfessionnel = isset($_POST['developpementProfessionnel']);

    // Créer l'objet Avantage
    $avantage = new Avantage(
        //null,
        $offre_id,
        $description,
        $avantagesSociaux,
        $avantagesFinanciers,
        $developpementProfessionnel
    );

    // Ajouter l'avantage
    $avantagesC->ajouterAvantage($avantage);

    echo "Avantage ajouté avec succès.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Avantage</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> <!-- Pour Bootstrap -->
</head>
<body>
    <div class="container mt-5">
        <h2>Ajouter un Avantage</h2>

        <!-- Formulaire pour ajouter un avantage -->
        <form method="post">
           

            <div class="mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>

            <div class="mb-3">
                <label for="avantagesSociaux">Avantages Sociaux</label>
                <input type="text" class="form-control" name="avantagesSociaux" required>
            </div>

            <div class="mb-3">
                <label for="avantagesFinanciers">Avantages Financiers</label>
                <input type="text" class="form-control" name="avantagesFinanciers" required>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="developpementProfessionnel">
                <label class="form-check-label" for="developpementProfessionnel">Développement Professionnel</label>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        <!-- Footer Start -->
      <div
        class="container-fluid bg-primary text-light footer mt-5 pt-5 wow fadeIn"
        data-wow-delay="0.1s"
      >
        <div class="container py-5 px-lg-5">
          <div class="row g-5">
            <div class="col-md-6 col-lg-3">
              <h5 class="text-white mb-4">Get In Touch</h5>
              <p>
                <i class="fa fa-map-marker-alt me-3"></i>123 Street, New York,
                USA
              </p>
              <p><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
              <p><i class="fa fa-envelope me-3"></i>info@example.com</p>
              <div class="d-flex pt-2">
                <a class="btn btn-outline-light btn-social" href=""
                  ><i class="fab fa-twitter"></i
                ></a>
                <a class="btn btn-outline-light btn-social" href=""
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a class="btn btn-outline-light btn-social" href=""
                  ><i class="fab fa-youtube"></i
                ></a>
                <a class="btn btn-outline-light btn-social" href=""
                  ><i class="fab fa-instagram"></i
                ></a>
                <a class="btn btn-outline-light btn-social" href=""
                  ><i class="fab fa-linkedin-in"></i
                ></a>
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
                  <img
                    class="img-fluid"
                    src="img/portfolio-1.jpg"
                    alt="Image"
                  />
                </div>
                <div class="col-4">
                  <img
                    class="img-fluid"
                    src="img/portfolio-2.jpg"
                    alt="Image"
                  />
                </div>
                <div class="col-4">
                  <img
                    class="img-fluid"
                    src="img/portfolio-3.jpg"
                    alt="Image"
                  />
                </div>
                <div class="col-4">
                  <img
                    class="img-fluid"
                    src="img/portfolio-4.jpg"
                    alt="Image"
                  />
                </div>
                <div class="col-4">
                  <img
                    class="img-fluid"
                    src="img/portfolio-5.jpg"
                    alt="Image"
                  />
                </div>
                <div class="col-4">
                  <img
                    class="img-fluid"
                    src="img/portfolio-6.jpg"
                    alt="Image"
                  />
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <h5 class="text-white mb-4">Newsletter</h5>
              <p>
                Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi.
                Curabitur facilisis ornare velit non vulpu
              </p>
              <div class="position-relative w-100 mt-3">
                <input
                  class="form-control border-0 rounded-pill w-100 ps-4 pe-5"
                  type="text"
                  placeholder="Your Email"
                  style="height: 48px"
                />
                <button
                  type="button"
                  class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"
                >
                  <i class="fa fa-paper-plane text-primary fs-4"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="container px-lg-5">
          <div class="copyright">
            <div class="row">
              <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                &copy; <a class="border-bottom" href="#">Your Site Name</a>, All
                Right Reserved.

                <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                Designed By
                <a class="border-bottom" href="https://htmlcodex.com"
                  >HTML Codex</a
                >
              </div>
              <div class="col-md-6 text-center text-md-end">
                <div class="footer-menu">
                  <a href="">Home</a>
                  <a href="">Cookies</a>
                  <a href="">Help</a>
                  <a href="">FQAs</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer End -->
    </div>
</body>
</html>
