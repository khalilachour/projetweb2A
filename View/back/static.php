<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projet/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/projet/Controller/offresC.php';

//require_once __DIR__ . '/../../config.php';
// Instancier le contrôleur
$offresC = new offresC();

// Récupérer les statistiques par fourchette de salaire
$salaireStats = $offresC->getStatistiquesParSalaire();

// Récupérer les statistiques pour le développement professionnel
$devProfStats = $offresC->getStatistiquesDeveloppementProfessionnel();
?>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projet/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/projet/Controller/offresC.php';

$offresC = new offresC();

$salaireStats = $offresC->getStatistiquesParSalaire();
$devProfStats = $offresC->getStatistiquesDeveloppementProfessionnel();
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Charts - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            /* Définir les dimensions des graphiques */
            .chart-container {
                width: 500px; /* Ajustez selon vos besoins */
                height: 350px; /* Ajustez selon vos besoins */
                margin: auto; /* Centrer les graphiques */
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
        <h1>Statistiques des Offres d'Emploi</h1>

    <!-- Graphique à Barres pour les Fourchettes de Salaire -->
    <h2>Statistiques par Fourchette de Salaire</h2>
    <div class="chart-container">
        <canvas id="salaireChart"></canvas>
    </div>

    <!-- Diagramme Circulaire pour le Développement Professionnel -->
    <h2>Statistiques du Développement Professionnel</h2>
    <div class="chart-container">
        <canvas id="devProfChart"></canvas>
    </div>

    <script>
        // Données pour le graphique à barres sur les fourchettes de salaire
        var salaireData = {
            labels: [
                <?php
                foreach ($salaireStats as $stat) {
                    echo "'" . htmlspecialchars($stat['salaire_range']) . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Nombre d\'Offres',
                data: [
                    <?php
                    foreach ($salaireStats as $stat) {
                        echo htmlspecialchars($stat['nombre_offres']) . ",";
                    }
                    ?>
                ],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Configuration du graphique à barres avec options d'échelle
        var ctx = document.getElementById('salaireChart').getContext('2d');
        var salaireChart = new Chart(ctx, {
            type: 'bar',
            data: salaireData,
            options: {
                responsive: true, // S'assurer que le graphique est réactif
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 10, // Limiter l'échelle pour les valeurs plus petites
                        ticks: {
                            stepSize: 1, // Ajuster le pas entre les étiquettes
                        },
                    },
                },
            },
        });

        // Données pour le diagramme circulaire sur le développement professionnel
        var devProfData = {
            labels: ['Oui', 'Non'],
            datasets: [{
                label: 'Développement Professionnel',
                data: [
                    <?php
                    foreach ($devProfStats as $stat) {
                        echo htmlspecialchars($stat['nombre_offres']) . ",";
                    }
                    ?>
                ],
                backgroundColor: ['#FF6384', '#36A2EB'],
                hoverOffset: 4,
            }],
        };

        // Configuration du diagramme circulaire
        var ctx2 = document.getElementById('devProfChart').getContext('2d');
        var devProfChart = new Chart(ctx2, {
            type: 'pie',
            data: devProfData,
            options: {
                responsive: true, // Réactivité
                plugins: {
                    legend: {
                        position: 'right', // Positionner la légende
                    },
                },
            },
        });
    </script>
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
