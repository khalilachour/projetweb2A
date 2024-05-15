
<?php
require_once '../config.php';
require_once '../Controller/offresC.php'; // Contrôleur pour les offres d'emploi
require_once '../Controller/avantagesC.php'; // Contrôleur pour les avantages
require_once '../Model/offres.php';
require_once '../Model/avantages.php';
session_start();
// Create an instance of the OffrecC class
$offrecController = new offresC();

// Call the method to display job offers for the logged-in company
$offres = $offrecController->afficherOffresPourSocieteConnectee();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Liste des Offres d'Emploi</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> <!-- Pour Bootstrap -->
    <!-- Logout button -->

</head>
<body>
    <div class="container my-5">
        <h2>Liste des Offres d'Emploi</h2>
        <form action="../View/logoutu.php" method="post" class="me-3">
            <button type="submit" name="logout" class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" style="color: blue; text-decoration: none;"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
        <!-- ajouter ajouter-->
        <form action="../View/addoffre.php" class="me-3">
            <button type="submit" name="ajouter une offre" class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" style="color: blue; text-decoration: none;"><i class="fas fa-sign-out-alt"></i> ajouter</button>
        </form>

        <!-- Formulaire de recherche et de tri -->
        <form method="GET" action="">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="recherche" placeholder="Rechercher des offres..." value="<?= htmlspecialchars($motCle) ?>">
                <select name="trier" class="form-select">
                    <option value="salaire" <?= (isset($_GET['trier']) && $_GET['trier'] == 'salaire') ? 'selected' : '' ?>>Salaire</option>
                    <option value="date" <?= (isset($_GET['trier']) && $_GET['trier'] == 'date') ? 'selected' : '' ?>>Date de publication</option>
                    <option value="titre" <?= (isset($_GET['trier']) && $_GET['trier'] == 'titre') ? 'selected' : '' ?>>Titre du poste</option>
                </select>
                <button class="btn btn-primary" type="submit">Rechercher</button>
            </div>
        </form>

        <div class="row">
            <!-- Afficher les offres d'emploi -->
            <?php if (count($offres) > 0): ?>
                <?php foreach ($offres as $offre): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"><?= htmlspecialchars($offre['titrePoste']) ?></h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Nom du Recruteur :</strong> <?= htmlspecialchars($offre['nomRecruteur']) ?></p>
                                <p><strong>Nom de la Société :</strong> <?= htmlspecialchars($offre['nomSociete']) ?></p>
                                <p><strong>Lieu :</strong> <?= htmlspecialchars($offre['lieu']) ?></p>
                                <p><strong>Date :</strong> <?= htmlspecialchars($offre['date']) ?></p>
                                <p><strong>Salaire :</strong> <?= htmlspecialchars($offre['salaire']) ?></p>
                                <p><strong>Type de Contrat :</strong> <?= htmlspecialchars($offre['typeContrat']) ?></p>
                                <p><strong>Compétences Requises :</strong> <?= htmlspecialchars($offre['competencesRequises']) ?></p>
                                <p><strong>Expérience :</strong> <?= htmlspecialchars($offre['experience']) ?> ans</p>
                                <p><strong>Description :</strong> <?= htmlspecialchars($offre['description']) ?></p>
                            </div>
                            <div class="card-footer text-center">
                                <!-- Boutons "Voir Avantages" et "Postuler" -->
                                <a href="listavant.php?offre_id=<?= $offre['id'] ?>" class="btn btn-primary">Voir Avantages</a>
                                <!-- Nouveau bouton "Postuler" -->
                                <a href="postuler.php?offre_id=<?= $offre['id'] ?>" class="btn btn-primary">Postuler</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>Aucune offre trouvée pour "<?= htmlspecialchars($motCle) ?>".</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Footer Start -->
        <div class="container-fluid bg-primary text-light footer mt-5 pt-5">
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
                            <a class="btn btn-outline-light btn-social" href=""><i la="fab fa-youtube"></i></a>
                            <a la="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i la="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Popular Link</h5>
                        <a class="btn btn-link" href="">About Us</a>
                        <a class="btn btn-link" href="">Contact Us</a>
                        <a class="btn btn-link" href="">Privacy Policy</a>
                        <a class="btn btn-link" href="">Terms & Conditions</a>
                        <a class="btn btn-link" href="">Career</a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Project Gallery</h5>
                        <div class="row g-2">
                            <div class="col-4">
                                <img class="img-fluid" src="img/portfolio-1.jpg" alt="Image" />
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="img/portfolio-2.jpg" alt="Image" />
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="img/portfolio-3.jpg" alt="Image" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Newsletter</h5>
                        <p>Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulpu</p>
                        <div class="position-relative w-100 mt-3">
                            <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" placeholder="Your Email" style="height: 48px" />
                            <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2">
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
                            &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.
                            Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
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

    <!-- Fichiers JavaScript nécessaires -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
