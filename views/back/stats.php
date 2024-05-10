<?php
// Inclusion du fichier de configuration
require_once 'C:/xampp/htdocs/nouveau/controller/compC.php';

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques selon le niveau</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Inclure la bibliothèque Chart.js -->
    <style>
        /* Ajoutez votre style CSS ici */
    </style>
</head>
<body>
    
    <h1>Statistiques selon le niveau</h1>
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
</body>
</html>
