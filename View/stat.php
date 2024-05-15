<?php
require_once '../config.php'; // Connexion à la base de données
require_once '../Controller/offresC.php'; // Contrôleur des offres

// Instancier le contrôleur
$offresC = new offresC();

// Récupérer les statistiques par fourchette de salaire
$salaireStats = $offresC->getStatistiquesParSalaire();

// Récupérer les statistiques pour le développement professionnel
$devProfStats = $offresC->getStatistiquesDeveloppementProfessionnel();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Statistiques des Offres d'Emploi</title>
    <!-- Inclure Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Définir les dimensions des graphiques */
        .chart-container {
            width: 300px; /* Ajustez selon vos besoins */
            height: 200px; /* Ajustez selon vos besoins */
            margin: auto; /* Centrer les graphiques */
        }
    </style>
</head>
<body>
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
</body>
</html>
