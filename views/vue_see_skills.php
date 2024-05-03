<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="style.css">-->
    <script src="script.js"></script>
    <title>Document</title>
</head>
<body>


<?php ob_start(); ?>

<section id="tt_voir" class="affichage">
            
            <h4>Liste des compétences</h4>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Niveau de maitrise</th>
                    <th>Description</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>

                <tbody>
                <?php foreach ($elements as $element): ?>
                <tr>
                    <td><?= $element->id ?></td>
                    <td><?= $element->nom ?></td>
                    <td><?= $element->niveau ?></td>
                    <td><?= $element->description ?></td>
                    <td><a href="delete2.php?id=<?php echo $element->id ?>">supprimer</a></td>
                    <td><a href="edit2.php?id=<?php echo $element->id ?>">modifier</a></td>
           
                </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

</section>



          


<?php $contenu = ob_get_clean(); ?>


<?php include_once 'vue_principale.php'; ?>
          

</body>
</html>