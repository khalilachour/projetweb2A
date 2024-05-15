
<!DOCTYPE html>
<html lang="en">
    


    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Static Navigation - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <title>List of Companies and Users</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        .list-container {
            display: none;
        }
        .active {
            font-weight: bold;
        }
        
    /* Styles spécifiques pour rendre le tableau plus petit */
    .table-smaller {
        font-size: 0.8rem; /* Réduit la taille de la police */
    }

    .table-smaller th,
    .table-smaller td {
        padding: 0.25rem; /* Réduit le remplissage des cellules */
    }
    </style>
</head>
<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch">
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Logout button -->
        <form action="/../../projet/View/logoutu.php" method="post" class="me-3">
            <button type="submit" name="logout" class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" style="color: white; text-decoration: none;"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
        <!-- User's name -->
        <div class="me-3 text-white">
        <?php
            session_start();
            if (isset($_SESSION["user_email"])) {
                // Check if the user is a company
                if ($_SESSION["user_type"] == 'societe' && isset($_SESSION["company"])) {
                    echo "<span class='text-secondary me-2'>Welcome, " . $_SESSION["company"] . "</span>";
                } else {
                    echo "<span class='text-secondary me-2'>Welcome, " . $_SESSION["username_up"] . "</span>";
                }
            }
            ?>
        </div>
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
                                    <a class="nav-link" href="layout-static.php">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.php">Statistics</a>
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
<div class="container py-5">
<div class="container py-5">
    <!-- Buttons for toggling between companies and users -->
        <div class="row justify-content-center mb-2">
            <div class="col-6 col-md-3">
                <button id="showCompanies" class="btn btn-primary btn-sm btn-block active">Companies</button>
            </div>
            <div class="col-6 col-md-3">
                <button id="showUsers" class="btn btn-primary btn-sm btn-block">Users</button>
            </div>
            <div class="col-6 col-md-3">
                <button id="showCand" class="btn btn-primary btn-sm btn-block">Candidatures</button>
            </div>
        </div>
</div>
        <!-- List of Companies -->
        <div id="companyList" class="list-container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="section-title position-relative text-center mb-5 pb-2">
                        <h2 class="mt-2">List of Companies</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Company Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Numero</th>
                                    <th>Capital</th>
                                    <th>Localisation</th>
                                    <th>Actions</th> <!-- Added Actions column -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- PHP code to populate company table rows -->
                                <?php
                                require_once __DIR__ . '/../../Controller/CompanyC.php';
                                require_once __DIR__ . '/../../Model/Company.php';
                                require_once __DIR__ . '/../../config.php';

                                $companyC = new CompanyC();

                                // Pagination configuration
                                $results_per_page = 5; // Number of results per page
                                $start_from = 0; // Default starting index

                                // Calculate current page number
                                $company_page = isset($_GET['company_page']) ? $_GET['company_page'] : 1;

                                // Retrieve companies for the current page
                                $companies = $companyC->listCompaniesPaginated(($company_page - 1) * $results_per_page, $results_per_page);

                                foreach ($companies as $company) {
                                    echo "<tr>";
                                    echo "<td>{$company['societe_id']}</td>";
                                    echo "<td>{$company['nom_societe']}</td>";
                                    echo "<td>{$company['email']}</td>";
                                    echo "<td>{$company['type']}</td>";
                                    echo "<td>{$company['numero']}</td>";
                                    echo "<td>{$company['capital']}</td>";
                                    echo "<td>{$company['localisation']}</td>";
                                    echo "<td><form action='/../../projet/View/delete_companies.php' method='post'><input type='hidden' name='companyId' value='{$company['societe_id']}'><button type='submit' class='btn btn-danger'>Delete</button></form></td>";
                                    echo "</tr>";
                                }

                                // Calculate total number of pages
                                $total_companies = $companyC->getTotalCompaniesCount();
                                $total_pages = ceil($total_companies / $results_per_page);
                                ?>
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div class="pagination justify-content-center mt-4">
                            <?php if ($company_page > 1): ?>
                                <a href="?company_page=<?php echo $company_page - 1; ?>" class="page-link">&laquo; Previous</a>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <a href="?company_page=<?php echo $i; ?>" class="page-link <?php echo ($i == $company_page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                            <?php endfor; ?>

                            <?php if ($company_page < $total_pages): ?>
                                <a href="?company_page=<?php echo $company_page + 1; ?>" class="page-link">Next &raquo;</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- List of Users -->
        <div id="userList" class="list-container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="section-title position-relative text-center mb-5 pb-2">
                        <h2 class="mt-2">List of Users</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Age</th>
                                    <th>Localisation</th>
                                    <th>Actions</th> <!-- You can add actions here -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- PHP code to populate user table rows -->
                                <?php
                                require_once __DIR__ . '/../../Controller/UserC.php';
                                require_once __DIR__ . '/../../Model/User.php';
                                require_once __DIR__ . '/../../config.php';

                                $userC = new UserController();

                                // Pagination configuration
                                $results_per_page = 5; // Number of results per page
                                $start_from = 0; // Default starting index

                                // Calculate current page number
                                $user_page = isset($_GET['user_page']) ? $_GET['user_page'] : 1;

                                // Retrieve users for the current page
                                $users = $userC->listUsersPaginated(($user_page - 1) * $results_per_page, $results_per_page);

                                foreach ($users as $user) {
                                    echo "<tr>";
                                    echo "<td>{$user['user_id']}</td>";
                                    echo "<td>{$user['username']}</td>";
                                    echo "<td>{$user['email']}</td>";
                                    echo "<td>{$user['type']}</td>";
                                    echo "<td>{$user['age']}</td>";
                                    echo "<td>{$user['localisation']}</td>";
                                    echo "<td><form action='/../../View/delete_Users.php' method='post'><input type='hidden' name='user_id' value='{$user['user_id']}'><button type='submit' class='btn btn-danger'>Delete</button></form></td>";
                                    echo "</tr>";
                                }

                                // Calculate total number of pages
                                $total_users = $userC->getTotalUsersCount();
                                $total_pages = ceil($total_users / $results_per_page);
                                ?>
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div class="pagination justify-content-center mt-4">
                            <?php if ($user_page > 1): ?>
                                <a href="?user_page=<?php echo $user_page - 1; ?>" class="page-link">&laquo; Previous</a>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <a href="?user_page=<?php echo $i; ?>" class="page-link <?php echo ($i == $user_page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                            <?php endfor; ?>

                            <?php if ($user_page < $total_pages): ?>
                                <a href="?user_page=<?php echo $user_page + 1; ?>" class="page-link">Next &raquo;</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- List of Cand -->
        <div id="candList" class="list-container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="section-title position-relative text-center mb-5 pb-2">
                        <h2 class="mt-2">Liste des candidatures</h2>
                    </div>
                    <div class="table-responsive">
                        <table  class="table table-striped table-sm table-smaller">
                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>IDOFFRE</th>
                                            <th>DATE</th>
                                            <th>CV</th>
                                            <th>Lettre de motivation</th>
                                            <th>Delete</th>
                                            <th>Competences</th>
                                            <th>Télécharger CV et Compétences</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php

include 'C:/xampp/htdocs/projet/Controller/candC.php';

$CC = new CandidatureController(); // Création de l'instance du contrôleur

$candidatures = $CC->listCandidatures(); // Récupération de la liste des candidatures
?>
                                    </tr>
    <?php foreach ($candidatures as $candidature) { ?>
        <tr>
            <td><?php echo $candidature['id'] ?></td>
            <td><?php echo $candidature['id_offre'] ?></td>
            <td><?php echo $candidature['date'] ?></td>
            <td><?php echo $candidature['cv'] ?></td>
            <td><?php echo $candidature['lettre'] ?></td>
            <td><button><a href="/projet/View/back/supp_cand3.php?id=<?php echo $candidature['id'] ?>">Delete</a></button></td>
            <td><a href="/projet/View/afficher_comp.php?id_candidature=<?php echo $candidature['id']  ?>">compétences</a></td>
            <td>
                    <a href="/nouveau/uploads/<?php echo $candidature['cv'] ?>" download>Télécharger CV</a><br>
                   <!-- <a href="afficher_comp.php?id_candidature=<?php //echo $candidature['id'] ?>" download>Télécharger Compétences</a>-->
                    <a href="/projet/View/generate_custom_file.php?id_candidature=<?php echo $candidature['id'] ?>" download>Télécharger Compétences </a><br>
                </td>
            
        </tr>
    <?php } ?>
                                        
                                    </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // JavaScript for toggling between company and user lists
        document.getElementById("showCompanies").addEventListener("click", function() {
            document.getElementById("companyList").style.display = "block";
            document.getElementById("userList").style.display = "none";
            document.getElementById("showCompanies").classList.add("active");
            document.getElementById("showUsers").classList.remove("active");
        });


        document.getElementById("showUsers").addEventListener("click", function() {
            document.getElementById("companyList").style.display = "none";
            document.getElementById("userList").style.display = "block";
            document.getElementById("showCompanies").classList.remove("active");
            document.getElementById("showUsers").classList.add("active");
        });




        document.getElementById("showCand").addEventListener("click", function() {
            document.getElementById("companyList").style.display = "none";
            document.getElementById("userList").style.display = "none";
            document.getElementById("candList").style.display = "block";
            document.getElementById("showCompanies").classList.remove("active");
            document.getElementById("showUsers").classList.remove("active");
            document.getElementById("showCand").classList.add("active");
        });

    </script>
</div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
