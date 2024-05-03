<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Document</title>
</head>
<body>

<h1>Calendrier pour la date <?= $date ?></h1>
    
    <?php if ($offreDetails): ?>
        <h2>Détails de l'offre</h2>
        <p>Nom de l'offre : <?= $offreDetails->nom_poste ?></p>
        <p>Lieu de l'offre : <?= $offreDetails->lieu ?></p>
    <?php endif; ?>

<?php
    
?>

<div class="container">
  <div class="calendar-container">
   
    <div class="calendar">
      <div class="month-navigation">
        <button id="prev-month">&lt;</button>
        <span id="current-month">January 2024</span>
        <button id="next-month">&gt;</button>
      </div>
      <table id="calendar">
        <thead>
          <tr>
            <th>Lun</th>
            <th>Mar</th>
            <th>Mer</th>
            <th>Jeu</th>
            <th>Ven</th>
            <th>Sam</th>
            <th>Dim</th>
          </tr>
        </thead>
        <tbody>
          <!-- Contenu du calendrier pour le mois actuel -->
        </tbody>
      </table>
    </div>
  </div>
  
  <div id="info-container" class="info-container">
    <h3>Rendez-vous</h3>
    <?php  
                // Vérifier si les données sont présentes dans l'URL
               /* if (isset($_GET['date'])) {
                    // Récupérer les données de l'URL
                    $selected_date = $_GET['date'];
                    $id_offre = $_GET['id_offre'];
                    
                    // Appeler la fonction pour récupérer les informations sur l'offre
                    $offre_info = get_details_offre($id_offre);
                    
                    // Afficher les informations
                    if ($offre_info) {
                        echo "<p>Date sélectionnée : $selected_date</p>";
                        echo "<p>Nom de l'offre : $offre_info->nom_poste</p>";
                        echo "<p>Lieu de l'offre : $offre_info->lieu</p>";
                    } else {
                        echo "<p>Erreur : Offre non trouvée.</p>";
                    }
                } else {
                    echo "<p>Aucune date sélectionnée.</p>";
                }*/
                ?>

                 <?php/* if ($offreDetails):*/ ?>
           <!-- <h2>Détails de l'offre</h2>
            <p>Nom de l'offre : <?//= //$offreDetails->nom_poste ?></p>
            <p>Lieu de l'offre : <?//= $offreDetails->lieu ?></p>-->
        <?php /*endif; */?>



        
    <div id="info-content">
                
<?php if ($offreDetails): 
    $urlDate = isset($_GET['date']) ? $_GET['date'] : ''; ?>
    <div id="Offre-details" urlDate=<?= $_GET['date']?> data-Nom="<?= $offreDetails->nom_poste ?>" data-Lieu="<?= $offreDetails->lieu ?>"></div>
   
    <?php endif; ?>
    </div>
  </div>
</div>







<script src="script2.js"></script>  
</body>
</html>
