<?php
// Inclusion du fichier de configuration
require_once 'C:/xampp/htdocs/projet/Controller/compC.php';

// Initialisation de l'objet CompetenceController
$compController = new CompetenceController();

// Récupération de toutes les compétences
$competences = $compController->listCompetences();

// Initialisation des compteurs pour chaque niveau
$debutantCount = 0;
$intermediaireCount = 0;
$avanceCount = 0;

// Parcourir les compétences pour compter les occurrences de chaque niveau
foreach ($competences as $competence) {
    switch ($competence['niveau']) {
        case 'debutant':
            $debutantCount++;
            break;
        case 'intermediaire':
            $intermediaireCount++;
            break;
        case 'avance':
            $avanceCount++;
            break;
    }
}

// Calcul du total des compétences
 $totalCompetences = $debutantCount + $intermediaireCount + $avanceCount;

// Calcul des pourcentages pour chaque niveau
$debutantPercentage = ($totalCompetences > 0) ? ($debutantCount / $totalCompetences) * 100 : 0;
$intermediairePercentage = ($totalCompetences > 0) ? ($intermediaireCount / $totalCompetences) * 100 : 0;
$avancePercentage = ($totalCompetences > 0) ? ($avanceCount / $totalCompetences) * 100 : 0;
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Inclure la bibliothèque Chart.js -->
    
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
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
                                <a class="nav-link" href="layout-static.php">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.php">Light Sidenav</a>
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
                    <h1 class="mt-4"><h1>Statistiques des compétences selon le niveau</h1></h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4 rounded-3">
                                <div class="card-body">Stats Company</div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-transparent">
                                    <a class="small text-white stretched-link" href="index.html" onclick="toggleChart('companyTypeChart')">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4 rounded-3">
                                <div class="card-body">Stats Compétences</div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-transparent">
                                    <a class="small text-white stretched-link" href="statsC.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4 rounded-3">
                                <div class="card-body">Stats offres</div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-transparent">
                                    <a class="small text-white stretched-link" href="stat.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4 rounded-3">
                                <div class="card-body">Stats Evenements</div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-transparent">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
    <canvas id="myChart" class="pie" width="400" height="400"></canvas> <!-- Canevas pour afficher le graphique -->
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie', // Type de graphique : pie chart
            data: {
                labels: ['Débutant', 'Intermédiaire', 'Avancé'], // Labels pour chaque niveau
                datasets: [{
                    label: 'Pourcentage de compétences selon le niveau',
                    data: [<?php echo $debutantPercentage; ?>, <?php echo $intermediairePercentage; ?>, <?php echo $avancePercentage; ?>], // Pourcentages pour chaque niveau
                    backgroundColor: [
                        'rgba(255, 159, 64, 0.5)', // Couleur pour le niveau débutant
                        'rgba(75, 192, 192, 0.5)', // Couleur pour le niveau intermédiaire
                        'rgba(54, 162, 235, 0.5)' // Couleur pour le niveau avancé
                    ],
                    borderColor: [
                        'rgba(255, 159, 64, 1)', // Couleur de la bordure pour le niveau débutant
                        'rgba(75, 192, 192, 1)', // Couleur de la bordure pour le niveau intermédiaire
                        'rgba(54, 162, 235, 1)' // Couleur de la bordure pour le niveau avancé
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false, // Empêcher le graphique de redimensionner de manière réactive
                maintainAspectRatio: false, // Empêcher le graphique de conserver son aspect ratio
                legend: {
                    display: true, // Afficher la légende
                    position: 'bottom' // Position de la légende (ici en bas)
                }
            }
        });
    </script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script>
        // Function to fetch data from PHP backend
        function fetchCompanyTypeData() {
            // Make an AJAX request to your PHP file
            // Replace 'your_php_file.php' with the actual path to your PHP file
            return fetch('fetch_company_types.php') 
                .then(response => response.json())
                .then(data => data)
                .catch(error => console.error('Error fetching data:', error));
        }
    
        // Function to update the chart with fetched data
        async function updateChart() {
            // Fetch company type data
            const companyTypeData = await fetchCompanyTypeData();
    
            // Chart.js code
            var ctx = document.getElementById('companyTypeChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(companyTypeData),
                    datasets: [{
                        label: 'Number of Companies',
                        data: Object.values(companyTypeData),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    
        // Call the updateChart function to initialize the chart
        updateChart();
    </script>
    <script>
        // Function to toggle chart visibility
        function toggleChart(chartId) {
            var chart = document.getElementById(chartId);
            if (chart.style.display === 'none') {
                chart.style.display = 'block';
            } else {
                chart.style.display = 'none';
            }
        }
    </script>
</body>

</html>
