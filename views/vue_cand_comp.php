<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>



<?php ob_start(); ?>


<table>
    <thead>
        <tr>
            <th>Nom de la compétence</th>
            <th>Niveau</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($competences as $competence): ?>
        <tr>
            <td><?php echo $competence->nom; ?></td>
            <td><?php echo $competence->niveau; ?></td>
            <td><?php echo $competence->description; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php $contenu = ob_get_clean(); ?>

<?php include_once 'vue_principale.php'; ?>



</body>
</html>