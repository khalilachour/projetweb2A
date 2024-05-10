<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixer un rendez-vous</title>
    <style>
        /* Style CSS pour le formulaire */
        /* Vous pouvez personnaliser ce style selon vos besoins */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        form {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form action="traitement_rendezvous.php" method="post">
        <h2>Fixer un rendez-vous</h2>
        <?php/*
        // Inclure le fichier de configuration de la base de données et le contrôleur des candidatures
        require_once 'C:/xampp/htdocs/nouveau/config.php';
        require_once 'C:/xampp/htdocs/nouveau/controller/candC.php';

        // Vérifier si l'ID de la candidature est présent dans l'URL
        if(isset($_GET['id_candidature'])) {
            // Récupérer l'ID de la candidature depuis l'URL
            $id_candidature = $_GET['id_candidature'];

            // Créer une instance du contrôleur des candidatures
            $candController = new CandidatureController();

            // Appeler la fonction pour récupérer les détails de l'offre associée à la candidature
            $offreDetails = $candController->getOffreDetailsByCandidatureId($id_candidature);

            // Vérifier si des résultats ont été trouvés
            if($offreDetails) {
                echo '<input type="hidden" name="id_candidature" value="' . $id_candidature . '">';

                // Afficher les données de l'offre (vous pouvez les utiliser dans le formulaire)
                echo '<input type="hidden" name="id_offre" value="' . $offreDetails['id'] . '">';
                //echo '<label for="nom_offre">Nom de l\'offre :</label>';
                echo '<input type="hidden" id="nom_offre" name="nom_offre" value="' . $offreDetails['nom_poste'] . '" readonly>';
                //echo '<label for="lieu_offre">Lieu de l\'offre :</label>';
                echo '<input type="hidden" id="lieu_offre" name="lieu_offre" value="' . $offreDetails['lieu'] . '" readonly>';
                

            } else {
                echo 'Aucune offre trouvée pour cette candidature.';
            }
        } else {
            echo 'ID de candidature non spécifié dans l\'URL.';
        }*/
        ?>
        <label for="date_rendezvous">Date du rendez-vous :</label>
        <input type="date" id="date_rendezvous" name="date_rendezvous" required>
        <input type="submit" value="Confirmer le rendez-vous">
    </form>
</body>
</html>-->











<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tables - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
        /* Style CSS pour le formulaire */
        /* Vous pouvez personnaliser ce style selon vos besoins */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        form {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <!--<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>-->
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tables</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                            <li class="breadcrumb-item active"><a href="afficher_cand.php">Candidatures</a></li>
                            <li class="breadcrumb-item active"><a href="all_comp.php">Competences</a></li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                
                            <form action="traitement_rendezvous.php" method="post">
        <h2>Fixer un rendez-vous</h2>
        <?php
        // Inclure le fichier de configuration de la base de données et le contrôleur des candidatures
        require_once 'C:/xampp/htdocs/nouveau/config.php';
        require_once 'C:/xampp/htdocs/nouveau/controller/candC.php';

        // Vérifier si l'ID de la candidature est présent dans l'URL
        if(isset($_GET['id_candidature'])) {
            // Récupérer l'ID de la candidature depuis l'URL
            $id_candidature = $_GET['id_candidature'];

            // Créer une instance du contrôleur des candidatures
            $candController = new CandidatureController();

            // Appeler la fonction pour récupérer les détails de l'offre associée à la candidature
            $offreDetails = $candController->getOffreDetailsByCandidatureId($id_candidature);

            // Vérifier si des résultats ont été trouvés
            if($offreDetails) {
                echo '<input type="hidden" name="id_candidature" value="' . $id_candidature . '">';

                // Afficher les données de l'offre (vous pouvez les utiliser dans le formulaire)
                echo '<input type="hidden" name="id_offre" value="' . $offreDetails['id'] . '">';
                //echo '<label for="nom_offre">Nom de l\'offre :</label>';
                echo '<input type="hidden" id="nom_offre" name="nom_offre" value="' . $offreDetails['nom_poste'] . '" readonly>';
                //echo '<label for="lieu_offre">Lieu de l\'offre :</label>';
                echo '<input type="hidden" id="lieu_offre" name="lieu_offre" value="' . $offreDetails['lieu'] . '" readonly>';
                

            } else {
                echo 'Aucune offre trouvée pour cette candidature.';
            }
        } else {
            echo 'ID de candidature non spécifié dans l\'URL.';
        }
        ?>
        <label for="date_rendezvous">Date du rendez-vous :</label>
        <input type="date" id="date_rendezvous" name="date_rendezvous" required>
        <input type="submit" value="Confirmer le rendez-vous">
    </form>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>


        



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
