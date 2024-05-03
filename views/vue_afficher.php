<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <title class="title">Dashboard</title>
</head>
<body>
<?php ob_start(); ?>
    <section class="menu">
        
        <div class="profil">
            <img src="images/photo2.jpg" alt="">
            <p>NadaAngar</p>
        </div>


        
        <div  class="element">
            <i class="fa-solid fa-house-user"></i>
            <a href="">Dashboard</a>
        </div>

        


        <div class="element">
            <i class="fa-solid fa-calendar"></i>
            <a href="">Candidatures</a>
        </div>

        
        <div class="element">
            <i class="fa-solid fa-chart-pie"></i>
            <a href="">Charts</a>
        </div>


        
        <div class="element logout" >
            <i class="fa-solid fa-right-to-bracket"></i>
            <a href="">Log out</a>
        </div>

    </section>              





    <section class="content">

        <div class="dashboard">
            <p>Dashboard</p>
            <i class="fa-solid fa-bars"></i>
        </div>



  




    <div class="filtrer">
        <p>Filtrer</p>
        <i class="fa-solid fa-filter"></i>
    </div>






    <div class="cand">
        <p>Candidatures</p>
        <i class="fa-solid fa-calendar"></i>
    </div>


    <table>
        <thead>
            <tr>
                <th class="th telement">ID</th>
                <th class="th telement">ID de l'offre</th>
                <th class="th telement">Date de soumission</th>
                <th class="th telement">CV</th>
                <th class="th telement">Lettre de motivation</th>
                <th class="th telement">Competences</th>
                <th class="th telement">Fixer une date</th>
  
            </tr>
        </thead>

        <tbody>

            <?php foreach ($elements as $element): ?>

            <tr>
                <td class="telement "><?= $element->id ?></td>
                <td class="telement "><?= $element->id_offre ?></td>
                <td class=" telement"><span class="p"><?= $element->date ?></span></td>
                <td class=" telement"><span class="c"><?= $element->cv ?></span></td>
                <td class=" telement"><span class="c"><?= $element->lettre ?></span></td>
                <td class="telement "></td>
                <!-- Ajoutez un bouton "Fixer une date" dans la colonne "Fixer une date" de chaque ligne -->
                <td class="telement"><button class="fix-date-btn" data-id="<?= $element->id ?>" data-id-offre="<?= $element->id_offre ?>">Fixer une date</button></td>

            </tr>


                        <!-- Section pour choisir une date (masquée par défaut) -->
            <section id="select-date-section" style="display: none;">
                <input type="date" id="selected-date">
                <button id="confirm-date-btn">Confirmer</button>
            </section>


            
        <?php endforeach; ?>

        </tbody>

    </table>



    </section>


















    <?php $contenu = ob_get_clean(); ?>


<?php include_once 'vue_principale.php'; ?>
          



</body>
</html>